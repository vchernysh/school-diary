<?php

namespace app\controllers\directors;

use Yii;
use app\models\{User, Classes, ClassSubjects, ClassTeachersAccess, ClassTeachersSubjectsAccess, Subjects, ClassLessonsSchedule, Students, Parents};
use app\models\search\{ClassesSearch, StudentsSearch, ParentsSearch};
use app\controllers\DirectorsController;
use yii\web\{Response, NotFoundHttpException};
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;

/**
 * ClassesController implements the CRUD actions for Classes model.
 */
class ClassesController extends DirectorsController
{

    public function init()
    {
        parent::init();

        if ($this->school__payment_type == 'all' &! $this->__payment_check)
        {
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

        $searchModel = new ClassesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['classes.school_id' => $this->_school->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // public function actionParentsOfStudent($class_id, $student_id)
    // {
    //     if ($this->findModel($class_id)->school_id == $this->_school->id) {

    //         $searchModel = new ParentsSearch();
    //         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    //         $dataProvider->query->andWhere(['parents.student_id' => $student_id]);
    //         $model = Students::findOne(['class_id' => $class_id, 'user_id' => $student_id]);

    //         if (!$model) {
    //             throw new \yii\web\NotFoundHttpException();
    //         }

    //         return $this->render('parents/parents-of-student', [
    //             'searchModel' => $searchModel,
    //             'dataProvider' => $dataProvider,
    //             'class' => $this->findModel($class_id),
    //             'model' => $model,
    //         ]);
    //     }

    //     throw new \yii\web\NotFoundHttpException();
    // }

    public function actionStudents($class_id)
    {
        if ($this->findModel($class_id)->school_id == $this->_school->id) {

            $searchModel = new StudentsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(['students.class_id' => $class_id]);

            return $this->render('students/students', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $this->findModel($class_id),
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionDeleteStudent($class_id, $student_id)
    {

        if ($this->findModel($class_id)->school_id == $this->_school->id) {

            $user_name = User::findOne($student_id)->name;
            User::removeUser($student_id);
            Yii::$app->session->setFlash('success', 'Користувач "<strong>' . $user_name . '</strong>" успішно видалений з системи!');

	        return $this->redirect(['students', 'class_id' => $class_id]);
        }
        
        throw new \yii\web\NotFoundHttpException();

    }

    // public function actionAddParents($class_id, $student_id = null)
    // {
    //     if ($this->findModel($class_id)->school_id == $this->_school->id) {

    //         $model = new Parents();
            
    //         $student_model = null;
    //         $students = null;

    //         if ($student_id) {
    //             $student_model = Students::findOne(['class_id' => $class_id, 'user_id' => $student_id]);
    //         } else {
    //             $students = User::find()
    //                 ->innerJoin('students', 'user.id = students.user_id')
    //                 ->select(['user.id', 'user.name'])
    //                 ->where(['students.class_id' => $this->_class->id])
    //                 ->all();
    //         }

    //         if ($student_id && !$student_model) {
    //             throw new \yii\web\NotFoundHttpException();
    //         }

    //         if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                       
    //            Yii::$app->response->format = Response::FORMAT_JSON;
    //            return ActiveForm::validate($model);
            
    //         }

    //         if ($model->load(Yii::$app->request->post()) && !Yii::$app->request->isAjax) {

    //             $user_model = new User();
    //             $user_model->email = $model->new_email;
    //             $user_model->username = $model->new_username;
    //             $user_model->name = $model->new_name;
    //             $user_model->phone = $model->new_phone;
    //             $user_model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;
    //             $user_model->password = Yii::$app->getSecurity()->generatePasswordHash(12345);
    //             $user_model->real_password = '12345';
    //             $user_model->image = '/images/_no_user.png';
    //             $user_model->type = 'parent';

    //             if ($user_model->save()) {

    //                 $model->user_id = Yii::$app->db->getLastInsertID();
    //                 $model->student_id = ($student_id) ? $student_id : $model->student_id;
    //                 $model->type = $model->type;

    //                 if ($model->save()) {

    //                     Yii::$app->session->setFlash('success', 'Ви успішно додали нового члена родини <strong>' . $model->new_name . '</strong> до школи!');
    //                     return $this->redirect(['parents-view', 'id' => $model->user_id, 'student_id' => $model->student_id]);
    //                 }
    //             }
                
    //         }

    //         return $this->render('parents/add-parents', [
    //             'model' => $model,
    //             'request' => Yii::$app->request->post('Parents'),
    //             'students' => $students,
    //             'student_model' => $student_model,
    //             'class' => $this->findModel($class_id),

    //         ]);
    //     }

    //     throw new \yii\web\NotFoundHttpException();

    // }

    // public function actionEditParents($class_id, $student_id = null)
    // {

    //     // if ($this->findModel($class_id)->school_id == $this->_school->id) {

    //     //     $model = Students::findOne(['class_id' => $class_id, 'user_id' => $student_id]);

    //     //     $model->new_username = $model->username;
    //     //     $model->new_email = $model->email;
    //     //     $model->new_phone = $model->phone;
    //     //     $model->new_name = $model->name;
    //     //     $model->birthday_string = ($model->user->birthday) ? date('d-m-Y', $model->user->birthday) : '';

    //     //     if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                   
    //     //        Yii::$app->response->format = Response::FORMAT_JSON;
    //     //        return ActiveForm::validate($model);
            
    //     //     }

    //     //     if ($model->load(Yii::$app->request->post()) && !Yii::$app->request->isAjax) {

    //     //         $user_model = User::findOne(['id' => $model->user_id]);

    //     //         $user_model->username = $model->new_username;
    //     //         $user_model->name = $model->new_name;
    //     //         $user_model->email = $model->new_email;
    //     //         $user_model->phone = $model->new_phone;
    //     //         $user_model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;

    //     //         if ($model->save()) {
    //     //             if ($user_model->save()) {
    //     //                 Yii::$app->session->setFlash('success', 'Ви успішно зберегли дані щодо учня <strong>' . $model->new_name . '</strong> - клас <strong>' . $model->class->name . '</strong>!');
    //     //                 return $this->redirect(['student', 'class_id' => $class_id, 'student_id' => $student_id]);
    //     //             }
    //     //         }
    //     //     }

    //     //     return $this->render('parents/edit-student', [
    //     //         'model' => $model,
    //     //         'class' => $this->findModel($class_id),
    //     //     ]);

    //     // }

    //     // throw new \yii\web\NotFoundHttpException();

    // }

    public function actionAddStudent($class_id)
    {

        if ($this->findModel($class_id)->school_id == $this->_school->id) {

            if ($this->school__payment_type == 'all' && $this->school__max_students <= $this->_count_students && $this->_school->is_test == 'no')
            {
                throw new \yii\web\NotFoundHttpException();
            }

            $model = new Students();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                       
               Yii::$app->response->format = Response::FORMAT_JSON;
               return ActiveForm::validate($model);
            
            }
                
            if ($model->load(Yii::$app->request->post()) && !Yii::$app->request->isAjax) {

                $user_model = new User();
                $user_model->email = $model->new_email;
                $user_model->username = $model->new_username;
                $user_model->name = $model->new_name;
                $user_model->fio = $model->new_fio;
                $user_model->phone = $model->new_phone;
                $user_model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;
                $user_model->password = Yii::$app->getSecurity()->generatePasswordHash(12345);
                $user_model->real_password = '12345';
                $user_model->image = '/images/_no_user.png';
                $user_model->type = 'student';

                if ($user_model->save()) {

                    $model->user_id = Yii::$app->db->getLastInsertID();
                    $model->class_id = $class_id;

                    if ($model->save()) {

                        Yii::$app->session->setFlash('success', 'Ви успішно додали учня <strong>' . $model->new_name . '</strong> до класу <strong>' . $model->class->name . '</strong>!');
                        return $this->redirect(['student', 'class_id' => $model->class_id, 'student_id' => $model->user_id]);
                    }
                }

            }

            return $this->render('students/add-student', [
                'model' => $model,
                'request' => Yii::$app->request->post('Students'),
                'class' => $this->findModel($class_id),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();

    }

    public function actionEditStudent($class_id, $student_id)
    {

        if ($this->findModel($class_id)->school_id == $this->_school->id) {

            $model = Students::findOne(['class_id' => $class_id, 'user_id' => $student_id]);

            $model->new_username = $model->username;
            $model->new_email = $model->email;
            $model->new_phone = $model->phone;
            $model->new_name = $model->name;
            $model->new_fio = $model->fio;
            $model->birthday_string = ($model->user->birthday) ? date('d-m-Y', $model->user->birthday) : '';

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                   
               Yii::$app->response->format = Response::FORMAT_JSON;
               return ActiveForm::validate($model);
            
            }

            if ($model->load(Yii::$app->request->post()) && !Yii::$app->request->isAjax) {

                $user_model = User::findOne(['id' => $model->user_id]);

                $user_model->username = $model->new_username;
                $user_model->name = $model->new_name;
                $user_model->fio = $model->new_fio;
                $user_model->email = $model->new_email;
                $user_model->phone = $model->new_phone;
                $user_model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;

                if ($model->save()) {
                    if ($user_model->save()) {
                        Yii::$app->session->setFlash('success', 'Ви успішно зберегли дані щодо учня <strong>' . $model->new_name . '</strong> - клас <strong>' . $model->class->name . '</strong>!');
                        return $this->redirect(['student', 'class_id' => $class_id, 'student_id' => $student_id]);
                    }
                }
            }

            return $this->render('students/edit-student', [
                'model' => $model,
                'class' => $this->findModel($class_id),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();

    }

    public function actionStudent($class_id, $student_id)
    {

        if ($this->findModel($class_id)->school_id == $this->_school->id) {
            
            return $this->render('students/student', [
                'model' => Students::findOne(['class_id' => $class_id, 'user_id' => $student_id]),
                'class' => $this->findModel($class_id),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();

    }

    /**
     * Displays a single Classes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {

            foreach ($this->findModel($id)->classTeachersAccess as $teacher) :
                
                $subjects = [];
                $classTeachersSubjectsAccess = Subjects::find()
                    ->innerJoin('class_teachers_subjects_access', 'class_teachers_subjects_access.subject_id = subjects.id')
                    ->where([
                        'class_id' => $id,
                        'teacher_id' => $teacher->id])
                    ->asArray()
                    ->all();

                if ($classTeachersSubjectsAccess) {
                    foreach($classTeachersSubjectsAccess as $subject) :
                        $subjects[] = $subject['subject_name'];
                    endforeach;
                }

                $classTeachersAccess[$teacher->id] = [
                    'id' => $teacher->id,
                    'name' => $teacher->name . ' - ' . $teacher->subject->subject,
                    'subjects' => $subjects,
                ];

            endforeach;

            $model = $this->findModel($id);
            $model->teachers_subjects = $classTeachersAccess;

            return $this->render('view', [
                'model' => $model,
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionLessonsScheduleEdit($id, $day)
    {
        if ($this->findModel($id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) {

                if (Yii::$app->request->post('action') == 'remove-lesson-from-schedule') {
                    $response = $this->removeLessonFromSchedule(Yii::$app->request->post());
                }

                return $response;
            }

            $day_schedule = $this->findModel($id)::getClassScheduleByDay($id, $day);

            $week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            if ($day_schedule || (!$day_schedule && in_array($day, $week))) {

                $new_lesson_schedule_model = new ClassLessonsSchedule();

                $daySchedule = $this->findModel($id)::getDay($day);

                $lessons = [];
                $lessons_id = [];

                foreach($day_schedule as $value) :
                    $schedule[$day]['lesson_number'][] = $value['lesson_number'];
                    $schedule[$day]['subject'][] = $value['subject_name'];
                    $schedule[$day]['subject_id'][] = $value['subject_id'];
                endforeach;

                $check = false;

                foreach($schedule as $day => $type) :
                    asort($type['lesson_number']);
                    foreach($type['lesson_number'] as $key => $value) :
                        $lessons[$day][$value][] = $type['subject'][$key];
                        $lessons_id[$day][$value][] = $type['subject_id'][$key];
                        if (count($lessons[$day][$value]) > 1 && !$check) :
                            $check = true;
                        endif;
                    endforeach;
                endforeach;

                $subjects = $this->findModel($id)->classSubjects;

                if ($new_lesson_schedule_model->load(Yii::$app->request->post())) {

                    $new_lesson_schedule_model->class_id = Yii::$app->request->post('class_id');
                    $new_lesson_schedule_model->day = Yii::$app->request->post('day');

                    if ($new_lesson_schedule_model->save()) {

                        Yii::$app->session->setFlash('success', 'Розклад успішно збережено!');

                        return $this->redirect(['lessons-schedule-edit', 'id' => $new_lesson_schedule_model->class_id, 'day' => $new_lesson_schedule_model->day]);
                    }
                }

                return $this->render('lessons-schedule-edit', [
                    'model' => $this->findModel($id),
                    'lessons' => $lessons,
                    'show_message' => $check,
                    'id' => $id,
                    'day' => $day,
                    'daySchedule' => $daySchedule,
                    'new_lesson_schedule_model' => $new_lesson_schedule_model,
                    'subjects' => $subjects,
                    'lessons_id' => $lessons_id,
                ]);
            
            }
            
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionLessons($id)
    {
        if ($this->findModel($id)->school_id == $this->_school->id) {

            $lessons_schedule = $this->findModel($id)->classSchedule;

            $lessons = [];
            $schedule = [];
            foreach($lessons_schedule as $value) :
                switch ($value['day']) :
                    case 'Monday' :
                        $schedule['Monday']['lesson_number'][] = $value['lesson_number'];
                        $schedule['Monday']['subject'][] = $value['subject_name'];
                        break;
                    case 'Tuesday' :
                        $schedule['Tuesday']['lesson_number'][] = $value['lesson_number'];
                        $schedule['Tuesday']['subject'][] = $value['subject_name'];
                        break;
                    case 'Wednesday' :
                        $schedule['Wednesday']['lesson_number'][] = $value['lesson_number'];
                        $schedule['Wednesday']['subject'][] = $value['subject_name'];
                        break;
                    case 'Thursday' :
                        $schedule['Thursday']['lesson_number'][] = $value['lesson_number'];
                        $schedule['Thursday']['subject'][] = $value['subject_name'];
                        break;
                    case 'Friday' :
                        $schedule['Friday']['lesson_number'][] = $value['lesson_number'];
                        $schedule['Friday']['subject'][] = $value['subject_name'];
                        break;
                    case 'Saturday' :
                        $schedule['Saturday']['lesson_number'][] = $value['lesson_number'];
                        $schedule['Saturday']['subject'][] = $value['subject_name'];
                        break;
                    case 'Sunday' :
                        $schedule['Sunday']['lesson_number'][] = $value['lesson_number'];
                        $schedule['Sunday']['subject'][] = $value['subject_name'];
                        break;
                endswitch;
            endforeach;

            $check = false;

           	foreach($schedule as $day => $type) :
			    asort($type['lesson_number']);
			    foreach($type['lesson_number'] as $key => $value) :
                    $lessons[$day][$value][] = $type['subject'][$key];
                    if (count($lessons[$day][$value]) > 1 && !$check) :
                        $check = true;
                    endif;
			    endforeach;
			endforeach;

            return $this->render('lessons', [
                'model' => $this->findModel($id),
                'lessons' => $lessons,
                'show_message' => $check,
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionTeachersSubjectsAccess($id)
    {
        if ($this->findModel($id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) :
                $subjects = ClassTeachersSubjectsAccess::find()
                    ->where([
                        'class_id' => Yii::$app->request->post('class_id'),
                        'teacher_id' => Yii::$app->request->post('teacher_id')])
                    ->asArray()->all();
                
                echo json_encode(['subjects' => $subjects]);
                return;
            endif;

            $another_model = new ClassTeachersSubjectsAccess();

            if ($another_model->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post('ClassTeachersSubjectsAccess');
                $classTeachersSubjectsAccess_model = ClassTeachersSubjectsAccess::find()
                    ->where([
                        'class_id' => $post['class_id'],
                        'teacher_id' => $post['teacher_id']])
                    ->all();

                foreach($classTeachersSubjectsAccess_model as $remove_model) :
                    $remove_model->delete();
                endforeach;

                foreach($post['subjects'] as $subject_id) :
                    $save_model = new ClassTeachersSubjectsAccess();
                    $save_model->class_id = $post['class_id'];
                    $save_model->teacher_id = $post['teacher_id'];
                    $save_model->subject_id = $subject_id;
                    $save_model->save();
                endforeach;

                Yii::$app->session->setFlash('success', 'Налаштування збережені!');
                return $this->refresh();
            }

            $class_subjects = $this->findModel($id)->classSubjects;
            foreach ($this->findModel($id)->classTeachersAccess as $teacher) :
                $classTeachersAccess[] = [
                    'id' => $teacher->id,
                    'name' => '• ' . $teacher->name . ' - ' . $teacher->subject->subject
                ];
            endforeach;

            return $this->render('teachers-subjects-access', [
                'model' => $this->findModel($id),
                'another_model' => $another_model,
                'class_teachers_access' => $classTeachersAccess,
                'class_subjects' => $class_subjects,
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionTeachersAccess($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) {

                if (Yii::$app->request->post('action') == 'assigned') {
                    $response = $this->revokeClassTeacherAccess(Yii::$app->request->post());
                } elseif (Yii::$app->request->post('action') == 'available') {
                    $response = $this->assignClassTeacherAccess(Yii::$app->request->post());
                }

                return $response;
            }

            $classTeachersAccess = $this->findModel($id)->classTeachersAccess;
            $school_teachers = $this->findModel($id)->schoolTeachers;
            
            return $this->render('teachers-access', [
                'model' => $this->findModel($id),
                'teachers' => $school_teachers,
                'class_teachers_access' => $classTeachersAccess,
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionSubjects($id)
    {
        if ($this->findModel($id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) {

            	if (Yii::$app->request->post('action') == 'assigned') {
            		$response = $this->revokeSubject(Yii::$app->request->post());
            	} elseif (Yii::$app->request->post('action') == 'available') {
            		$response = $this->assignSubject(Yii::$app->request->post());
            	}

            	return $response;
            }

            $school_subjects = $this->findModel($id)->schoolSubjects;
            $class_subjects = $this->findModel($id)->classSubjects;
            
            return $this->render('subjects', [
                'model' => $this->findModel($id),
                'subjects' => $school_subjects,
                'class_subjects' => $class_subjects,
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    private function removeLessonFromSchedule($post = [])
    {
        $lesson = ClassLessonsSchedule::findOne([
            'class_id' => $post['class_id'],
            'day' => $post['day'],
            'lesson_number' => $post['lesson_number'],
            'subject_id' => $post['subject_id'],
        ]);
        if ($lesson) {
            $lesson->delete();
            $response = 'removed';
        } else {
            $response = 'not exists';
        }

        $check = false;

        $lesson_number = ClassLessonsSchedule::findOne([
            'class_id' => $post['class_id'],
            'day' => $post['day'],
            'lesson_number' => $post['lesson_number']
        ]);

        if ($lesson_number) {
            $check = true;
        }
        
        echo json_encode(['answer' => $response, 'check' => $check]);
    }

    private function assignClassTeacherAccess($post = [])
    {
        foreach($post['teachers'] as $teacher_id) :

            $model = new ClassTeachersAccess();
            $model->class_id = $post['class_id'];
            $model->teacher_id = $teacher_id;
            $model->save();

        endforeach;
        
        echo json_encode(['teachers' => $post['teachers']]);
    }

    private function revokeClassTeacherAccess($post = [])
    {
        foreach($post['teachers'] as $teacher_id) :

            $model_ClassTeachersAccess = ClassTeachersAccess::findOne(['class_id' => $post['class_id'], 'teacher_id' => $teacher_id]);
            $model_ClassTeachersAccess->delete();

            ClassTeachersSubjectsAccess::deleteAll(['class_id' => $post['class_id'], 'teacher_id' => $teacher_id]);

        endforeach;

        echo json_encode(['teachers' => $post['teachers']]);
    }

    private function revokeSubject($post = [])
    {

    	foreach($post['subjects'] as $subject_id) :

    		$model_ClassSubjects = ClassSubjects::findOne(['class_id' => $post['class_id'], 'subject_id' => $subject_id]);
            $model_ClassSubjects->delete();

            ClassTeachersSubjectsAccess::deleteAll(['class_id' => $post['class_id'], 'subject_id' => $subject_id]);
            ClassLessonsSchedule::deleteAll(['class_id' => $post['class_id'], 'subject_id' => $subject_id]);

    	endforeach;

        echo json_encode(['subjects' => $post['subjects']]);
    }

    private function assignSubject($post = [])
    {

		foreach($post['subjects'] as $subject_id) :

			$model = new ClassSubjects();
			$model->class_id = $post['class_id'];
			$model->subject_id = $subject_id;
			$model->save();

    	endforeach;
		
        echo json_encode(['subjects' => $post['subjects']]);
    }

    /**
     * Creates a new Classes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Classes();

        $teachers = [];
        $i = 0;
        foreach($model->class_teachers as $key => $value) :

            $teachers[$i]['id'] = $value['user_id'];
            $teachers[$i]['name'] = $value['name'] . ' - ' . $value['subject'];

            $i++;
        endforeach;

        if ($model->load(Yii::$app->request->post())) {

            $model->class_teacher_id = Yii::$app->request->post('Classes')['teacher_id'];
            $model->school_id = $this->_school->id;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Клас "<strong>' . $model->name . '</strong>" успішно додано у систему!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'teachers' => $teachers,
            'request' => Yii::$app->request->post('Classes'),
        ]);
    }

    /**
     * Updates an existing Classes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {

            $model = $this->findModel($id);

            $teachers = [];
            if ($model->class_teacher_id) {
                $teachers[0]['id'] = $model->class_teacher_id;
                $teachers[0]['name'] = $model->teacher_name . ' - ' . $model->subject->subject;
            }

            $i = 1;
            foreach($model->class_teachers as $key => $value) :

                $teachers[$i]['id'] = $value['user_id'];
                $teachers[$i]['name'] = $value['name'] . ' - ' . $value['subject'];

                $i++;
            endforeach;

            if ($model->load(Yii::$app->request->post())) {

                $model->class_teacher_id = Yii::$app->request->post('Classes')['teacher_id'];
                $model->school_id = $this->_school->id;
                
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'teachers' => $teachers,
                'request' => Yii::$app->request->post('Classes'),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Deletes an existing Classes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {

            $class_name = $this->findModel($id)->name;
            Classes::removeClass($id);
            Yii::$app->session->setFlash('success', 'Клас "<strong>' . $class_name . '</strong>" успішно видалений з системи!');

            return $this->redirect(['index']);
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
        if (($model = Classes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
