<?php

namespace app\controllers\teachers\_my_class;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\{Marks, Classes, ClassSubjects, ClassTeachersAccess, ClassTeachersSubjectsAccess, Subjects, Students, User};
use app\controllers\TeachersController as TeacherCONTROLLER;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\DynamicModel;

/**
 * RatingController implements the CRUD actions for Marks model.
 */
class RatingController extends TeacherCONTROLLER
{

    public function init()
    {
        parent::init();
        
        if (!$this->director_teacher || ($this->school__payment_type == 'all' &! $this->__payment_check)) {
            throw new \yii\web\NotFoundHttpException();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Classes models.
     * @return mixed
     */
    public function actionIndex()
    {

        $classSubjects = Classes::findOne($this->_class->id)->classSubjects;
        $subjects = ArrayHelper::map($classSubjects, 'id', 'subject_name');
        
        $model = new DynamicModel(['subjects']);
        $model->addRule(['subjects'], 'required', ['message' => 'Необхідно вибрати предмет.']);

        if (Yii::$app->request->post('DynamicModel')) {

            $post = Yii::$app->request->post();

            $subject_id = $post['DynamicModel']['subjects'];

            $check = ClassSubjects::findOne(['class_id' => $this->_class->id, 'subject_id' => $subject_id]);
            if ($check) {
                if ($post['add-new-mark']) {
                    return $this->redirect(['add-new-marks', 'subject_id' => $subject_id]);
                } elseif ($post['get-marks-sheet']) {
                    return $this->redirect(['marks', 'subject_id' => $subject_id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Трапилася помилка, спробуйте ще раз!');
                    return $this->refresh();
                }
            } else {
                Yii::$app->session->setFlash('error', 'Трапилася помилка, спробуйте ще раз!');
                return $this->refresh();
            }

        }

        return $this->render('index', compact('subjects', 'model'));
    }

    public function actionCheckUnderTitleForMarks()
    {
        if (Yii::$app->request->isAjax)
        {
            $post = Yii::$app->request->post();
            if ($post['action'] == 'check_titles') {

                $check = false;

                foreach(array_count_values($post['array_titles_value']) as $key => $value) {
                    if ($key != '0' && $value > 1) {
                        $check = true;
                    }
                }

                if ($check) {
                    
                    Yii::$app->session->setFlash('error', 'Трапилася помилка, спробуйте ще раз!');
                    return $this->redirect(['add-new-marks', 'subject_id' => $post['subject_id']]);

                } else {
                    $titles = $this->title_for_marks_sheet;
                    $options_html = [];
                    foreach($post['array_titles_value'] as $key => $value) :
                        $options_html[$key] = $titles;
                    endforeach;

                    for ($i = 0; $i < count($options_html); $i++) :
                        foreach($post['array_titles_value'] as $key => $value) :
                            if ($key != $i) {
                                unset($options_html[$i][$value]);
                            }
                        endforeach;
                    endfor;

                    return json_encode(['selected_items' => $post['array_titles_value'], 'list_of_items' => $options_html]);
                }

            } else {
                Yii::$app->session->setFlash('error', 'Трапилася помилка, спробуйте ще раз!');
                return $this->redirect(['add-new-marks', 'subject_id' => $post['subject_id']]);
            }
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAddNewMarks($subject_id)
    {

        $check = ClassSubjects::findOne(['class_id' => $this->_class->id, 'subject_id' => $subject_id]);

        if ($check) {
        
            $subject = Subjects::findOne($subject_id);
            $students = Students::getStudentsByClass($this->_class->id);

            $model = new Marks();

            $titles = $this->title_for_marks_sheet;
            $marks = $this->type_marks;
            $class_id = $this->_class->id;

            if (Yii::$app->request->post() && Yii::$app->request->post('save-marks-submit-button') == 'true') {
                
                $post = Yii::$app->request->post();

                foreach($post['marks_info'] as $key => $value) :
                    foreach($value as $id => $field) {


                    	if (!empty($field['mark']) && isset($field['id'])) {

                    		$marks_model = Marks::findOne(['id' => $field['id']]);
                    		
                    		if ($marks_model->mark != $field['mark'] || $marks_model->under_title != $field['type_mark']) {
                    			
	                            $marks_model->under_title = $field['type_mark'];
	                            $marks_model->mark = $field['mark'];
	                            
                                if ($marks_model->save()) :

                                    $student_user = User::findOne(['id' => $field['student_id']]);

                                    if ($student_user && ($student_user->school->is_test == 'yes' || ($student_user->paymentOfUser && $student_user->paymentOfUser['max_date'] > time())))
                                    {

                                        $telegram_ids = User::getParentsTelegramIDs($field['student_id']);
                                        
                                        $telegram_text = urlencode("<b>Оцінку змінено</b>:\n\n<b>Дата</b>: <code>" . myDate('ua', $post['date']) . " (" . myDayOfWeek('ua', $post['date']) . ")" . "</code>\n<b>Предмет</b>: <code>" . $subject->subject_name . "</code>\n<b>Тема</b>: <code>" . $this->title_for_marks_sheet[$field['type_mark']] . "</code>\n<b>Оцінка</b>: <code>" . $field['mark'] . "</code>\n<b>Вчитель</b>: <code>" . Yii::$app->user->identity->name . "</code>");

                                        if ($student_user->telegram->telegram_chat_id)
                                        {
                                            $response = $this->curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $telegram_text . '&chat_id=' . $student_user->telegram->telegram_chat_id . '&parse_mode=HTML');
                                        }

                                        if (!empty($telegram_ids))
                                        {
                                            foreach($telegram_ids as $key => $value) :
                                                $response = $this->curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $telegram_text . '&chat_id=' . $value['telegram_chat_id'] . '&parse_mode=HTML');
                                            endforeach;
                                        }
                                    }

                                endif;

                    		}

                    	} elseif (!empty($field['mark']) && !isset($field['id'])) {

                    		$marks_model = new Marks();

                            $marks_model->class_id = $this->_class->id;
                            $marks_model->student_id = $field['student_id'];
                            $marks_model->subject_id = $subject_id;
                            $marks_model->under_title = $field['type_mark'];
                            $marks_model->mark = $field['mark'];
                            $marks_model->date = $post['date'];
                            
                            if ($marks_model->save()) :

                                $student_user = User::findOne(['id' => $field['student_id']]);

                                if ($student_user && ($student_user->school->is_test == 'yes' || ($student_user->paymentOfUser && $student_user->paymentOfUser['max_date'] > time())))
                                {

                                    $telegram_ids = User::getParentsTelegramIDs($field['student_id']);
                                    
                                    $telegram_text = urlencode("<b>Нова оцінка</b>:\n\n<b>Дата</b>: <code>" . myDate('ua', $post['date']) . " (" . myDayOfWeek('ua', $post['date']) . ")" . "</code>\n<b>Предмет</b>: <code>" . $subject->subject_name . "</code>\n<b>Тема</b>: <code>" . $this->title_for_marks_sheet[$field['type_mark']] . "</code>\n<b>Оцінка</b>: <code>" . $field['mark'] . "</code>\n<b>Вчитель</b>: <code>" . Yii::$app->user->identity->name . "</code>");
                                    
                                    if ($student_user->telegram->telegram_chat_id)
                                    {
                                        $response = $this->curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $telegram_text . '&chat_id=' . $student_user->telegram->telegram_chat_id . '&parse_mode=HTML');
                                    }

                                    if (!empty($telegram_ids))
                                    {
                                        foreach($telegram_ids as $key => $value) :
                                            $response = $this->curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $telegram_text . '&chat_id=' . $value['telegram_chat_id'] . '&parse_mode=HTML');
                                        endforeach;
                                    }
                                }

                            endif;
                    		
                    	} elseif (empty($field['mark']) && isset($field['id'])) {

                    		$marks_model = Marks::findOne(['id' => $field['id']]);
                            
                            if (Marks::findOne(['id' => $field['id']])->delete()) :

                                $student_user = User::findOne(['id' => $marks_model->student_id]);

                                if ($student_user && ($student_user->school->is_test == 'yes' || ($student_user->paymentOfUser && $student_user->paymentOfUser['max_date'] > time())))
                                {

                                    $telegram_ids = User::getParentsTelegramIDs($marks_model->student_id);
                                    
                                    $telegram_text = urlencode("<b>Оцінку видалено</b>:\n\n<b>Дата</b>: <code>" . myDate('ua', $post['date']) . " (" . myDayOfWeek('ua', $post['date']) . ")" . "</code>\n<b>Предмет</b>: <code>" . $subject->subject_name . "</code>\n<b>Тема</b>: <code>" . $this->title_for_marks_sheet[$marks_model->under_title] . "</code>\n<b>Оцінка</b>: <code>" . $marks_model->mark . "</code>\n<b>Вчитель</b>: <code>" . Yii::$app->user->identity->name . "</code>");
                                    
                                    if ($student_user->telegram->telegram_chat_id)
                                    {
                                        $response = $this->curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $telegram_text . '&chat_id=' . $student_user->telegram->telegram_chat_id . '&parse_mode=HTML');
                                    }

                                    if (!empty($telegram_ids))
                                    {
                                        foreach($telegram_ids as $key => $value) :
                                            $response = $this->curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $telegram_text . '&chat_id=' . $value['telegram_chat_id'] . '&parse_mode=HTML');
                                        endforeach;
                                    }
                                }

                            endif;
                    		
                    	}

                    }
                endforeach;

                Yii::$app->session->setFlash('success', 'Оцінки успішно збережені станом на <strong>' . myDate('ua', $post['date']) . ' - ' . myDayOfWeek('ua', $post['date']) . '</strong>');

                return $this->redirect(['marks', 'subject_id' => $post['subject_id']]);
            }

            return $this->render('add-new-marks', compact('subject_id', 'class_id', 'subject', 'model', 'students', 'titles', 'marks'));
        }

        throw new \yii\web\NotFoundHttpException();
        
    }

    public function actionCheckDateForAddingMarks()
    {
        if (Yii::$app->request->isAjax)
        {
            $post = Yii::$app->request->post();

            if ($post['date']) {

                $search_date = strtotime($post['date']);
                $subject_id = $post['subject_id'];

                $check = ClassSubjects::findOne(['class_id' => $this->_class->id, 'subject_id' => $subject_id]);

                if ($check) {

                    $students = Students::getStudentsByClass($this->_class->id);
                    $subject = Subjects::findOne($subject_id);
                    $check_columns = [];

                    $marks_of_date = Marks::getMarks($this->_class->id, $subject_id, $search_date);

                    $titles = $this->title_for_marks_sheet;
                    $marks = $this->type_marks;

                    if (!$marks_of_date) {

                        $html = $this->renderAjax('_ajax_add_marks', compact('subject_id', 'subject', 'students', 'titles', 'marks', 'search_date'));
                        return json_encode($html);

                    }
                    else {
                        foreach($marks_of_date as $date => $value) {
                            foreach($value as $title => $values) {
                                foreach($values as $id => $mark) {
                                    $check_columns[$date][] = count($mark['mark']) + count($value) - 1;
                                }
                            }
                        }
                        
                        $columns = max($check_columns[$search_date]);

                        $html = $this->renderAjax('_ajax_add_marks', compact('subject_id', 'subject', 'students', 'titles', 'marks', 'marks_of_date', 'columns', 'search_date'));
                        return json_encode($html);

                    }

                } else {
                    return json_encode('Помилка, спробуйте ще раз');
                }

            } else {
                return json_encode('<h4>Виберіть дату</h4>');
            }
        }

        throw new \yii\web\NotFoundHttpException();

    }
    
    public function actionMarks($subject_id, $from = null, $to = null)
    {

        $classSubjects = Classes::findOne($this->_class->id)->classSubjects;
        $subjects = ArrayHelper::map($classSubjects, 'id', 'subject_name');

        if (Yii::$app->request->isAjax)
        {
            return $this->redirect(['marks', 'subject_id' => Yii::$app->request->get('subject_id')]);
        }
        if (!is_null($from) && !is_null($to)) {
        	$check_period = strtotime($to) - strtotime($from);
        }

        if (in_array($subject_id, array_keys($subjects))) {

        	if (Yii::$app->request->post('filter-search-submit-button') && Yii::$app->request->post('filter-search-submit-button') == 'true')
	    	{
	    		$date_from = Yii::$app->request->post('date_from');
	    		$date_to = Yii::$app->request->post('date_to');

	    		if (!empty($date_from) && !empty($date_to)) {

	    			$period = strtotime($date_to) - strtotime($date_from);
	    			if ($period >= 0) {
	    				return $this->redirect(['marks', 'subject_id' => $subject_id, 'from' => $date_from, 'to' => $date_to]);
	    			} else {
	    				Yii::$app->session->setFlash('error', 'Помилка. Значення "Від" не може бути більшим за значення "До". Спробуйте ще раз!');
                    	return $this->refresh();
	    			}
	    		} elseif (empty($date_from) && empty($date_to)) {
	    			return $this->redirect(['marks', 'subject_id' => $subject_id]);
	    		} else {
	    			if (!empty($date_from)) {
						return $this->redirect(['marks', 'subject_id' => $subject_id, 'from' => $date_from]);
	    			} elseif (!empty($date_to)) {
	    				return $this->redirect(['marks', 'subject_id' => $subject_id, 'to' => $date_to]);
	    			}
	    		}
	    		// condition - filter search by date;
	    	}

	    	if ($check_period && $check_period < 0) {
				Yii::$app->session->setFlash('error', 'Помилка. Значення "Від" не може бути більшим за значення "До". Спробуйте ще раз!');
				return $this->redirect(['marks', 'subject_id' => $subject_id]);
			}

            $class = Classes::findOne($this->_class->id);

            $check = false;
            $subject = null;
            $colspan_number = [];
            $check_columns = [];

            foreach($class->classSubjects as $key => $value) :
                if ($value['id'] == $subject_id && !$check) {
                    $check = true;
                }
            endforeach;

            if ($check) {
                $subject = Subjects::findOne($subject_id);
            }

            $students = Students::getStudentsByClass($this->_class->id);
            $marks = Marks::getMarks($this->_class->id, $subject_id, null, $from, $to);
            
            foreach($marks as $date => $value) {
                foreach($value as $title => $values) {
                    foreach($values as $id => $mark) {
                        $check_columns[$date][] = count($mark['mark']) + count($value) - 1;
                    }
                }
            }
            
            $skips_was_not_from = '';
            $skips_was_sick_from = '';
            $skips_was_not_to = '';
            $skips_was_sick_to = '';

            if (!is_null($from)) {
            	$skips_was_not_from = ['>=', 'date', strtotime($from)];
            	$skips_was_sick_from = ['>=', 'date', strtotime($from)];
            }
            
            if (!is_null($to)) {
				$skips_was_not_from = ['<=', 'date', strtotime($to)];
            	$skips_was_sick_from = ['<=', 'date', strtotime($to)];
            }

            $skips_was_not = Marks::find()
            	->select(['COUNT(*) AS count, `student_id`'])
            	->where(['mark' => 'н'])
            	->andWhere($skips_was_not_from)
            	->andWhere($skips_was_not_to)
            	->andWhere(['class_id' => $this->_class->id, 'subject_id' => $subject_id])
            	->groupBy('student_id')
            	->asArray()->all();

            $skips_was_sick = Marks::find()
            	->select(['COUNT(*) AS count, `student_id`'])
            	->where(['mark' => 'хв'])
            	->andWhere($skips_was_sick_from)
            	->andWhere($skips_was_sick_to)
            	->andWhere(['class_id' => $this->_class->id, 'subject_id' => $subject_id])
            	->groupBy('student_id')
            	->asArray()->all();
            
            foreach($skips_was_not as $key => $value) {
                $student_skips['was_not'][$value['student_id']] = $value['count'];
            }
            foreach($skips_was_sick as $key => $value) {
                $student_skips['was_sick'][$value['student_id']] = $value['count'];
            }

            foreach($check_columns as $date => $values) {
                $colspan_number[$date] = max($values);
            }

            $titles = $this->title_for_marks_sheet;

            return $this->render('marks', compact('subject', 'marks', 'students', 'subjects', 'titles', 'colspan_number', 'student_skips', 'subject_id'));

        }

        throw new \yii\web\NotFoundHttpException();
    	
    }
    
    /**
     * Finds the Classes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Marks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
