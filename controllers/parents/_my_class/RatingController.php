<?php

namespace app\controllers\parents\_my_class;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\{Marks, Classes, ClassSubjects, ClassTeachersAccess, ClassTeachersSubjectsAccess, Subjects, Students};
use app\controllers\ParentsController as ParentCONTROLLER;
use yii\web\NotFoundHttpException;
use yii\base\DynamicModel;

/**
 * RatingController implements the CRUD actions for Marks model.
 */
class RatingController extends ParentCONTROLLER
{

    public function init()
    {
        parent::init();

        if (!$this->__payment_check)
        {
            throw new \yii\web\NotFoundHttpException();
        }
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
                if ($post['get-marks-sheet']) {
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

    public function actionMarks($subject_id, $from = null, $to = null, $only_me = null)
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

                $array_only_me = [];
                if (!is_null($only_me) && $only_me == 1) {
                    $array_only_me['only_me'] = '1';
                }

	    		$date_from = Yii::$app->request->post('date_from');
	    		$date_to = Yii::$app->request->post('date_to');

	    		if (!empty($date_from) && !empty($date_to)) {

	    			$period = strtotime($date_to) - strtotime($date_from);
	    			if ($period >= 0) {
	    				return $this->redirect(['marks', 'subject_id' => $subject_id, 'from' => $date_from, 'to' => $date_to] + $array_only_me);
	    			} else {
	    				Yii::$app->session->setFlash('error', 'Помилка. Значення "Від" не може бути більшим за значення "До". Спробуйте ще раз!');
                    	return $this->refresh();
	    			}
	    		} elseif (empty($date_from) && empty($date_to)) {
	    			return $this->redirect(['marks', 'subject_id' => $subject_id] + $array_only_me);
	    		} else {
	    			if (!empty($date_from)) {
						return $this->redirect(['marks', 'subject_id' => $subject_id, 'from' => $date_from] + $array_only_me);
	    			} elseif (!empty($date_to)) {
	    				return $this->redirect(['marks', 'subject_id' => $subject_id, 'to' => $date_to] + $array_only_me);
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
            
            $students = shuffle_assoc($students);
            $current_student_name = $students[Yii::$app->user->identity->children->user_id];
            unset($students[Yii::$app->user->identity->children->user_id]);

            foreach($students as $id => $name) :
                $students[$id] = '';
            endforeach;

            if (!is_null($only_me) && $only_me == 1) {
                $students = [Yii::$app->user->identity->children->user_id => $current_student_name];
            } else {
                $students = [Yii::$app->user->identity->children->user_id => $current_student_name] + $students;
            }

            $array_of_get_parameters = [];
            if (!is_null($from)) {
                $array_of_get_parameters['from'] = $from;
            }
            if (!is_null($to)) {
                $array_of_get_parameters['to'] = $to;
            }

            $chart = '';
            if ($marks) {
                $chart = $this->renderAjax('_ajax_chart', compact('marks', 'current_student_name', 'titles'));
            }

            return $this->render('marks', compact('subject', 'array_of_get_parameters', 'marks', 'students', 'subjects', 'titles', 'colspan_number', 'student_skips', 'subject_id', 'chart'));

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
