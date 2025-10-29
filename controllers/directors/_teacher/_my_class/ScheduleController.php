<?php

namespace app\controllers\directors\_teacher\_my_class;

use Yii;
use app\models\{Classes, ClassLessonsSchedule};
use app\controllers\DirectorsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScheduleController implements the CRUD actions for Classes model.
 */
class ScheduleController extends DirectorsController
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

    public function actionSchedule()
    {
        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            $lessons_schedule = $this->findModel($this->_class->id)->classSchedule;

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

            return $this->render('schedule', [
                'model' => $this->findModel($this->_class->id),
                'lessons' => $lessons,
                'show_message' => $check,
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    public function actionScheduleEdit($day)
    {
        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            if (Yii::$app->request->isAjax) {

                if (Yii::$app->request->post('action') == 'remove-lesson-from-schedule') {
                    $response = $this->removeLessonFromSchedule(Yii::$app->request->post());
                }

                return $response;
            }

            $day_schedule = $this->findModel($this->_class->id)::getClassScheduleByDay($this->_class->id, $day);

            $week = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            if ($day_schedule || (!$day_schedule && in_array($day, $week))) {

                $new_lesson_schedule_model = new ClassLessonsSchedule();

                $daySchedule = $this->findModel($this->_class->id)::getDay($day);

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

                $subjects = $this->findModel($this->_class->id)->classSubjects;

                if ($new_lesson_schedule_model->load(Yii::$app->request->post())) {

                    $new_lesson_schedule_model->class_id = $this->_class->id;
                    $new_lesson_schedule_model->day = Yii::$app->request->post('day');

                    if ($new_lesson_schedule_model->save()) {

                        Yii::$app->session->setFlash('success', 'Розклад успішно збережено!');

                        return $this->redirect(['schedule-edit', 'day' => $new_lesson_schedule_model->day]);
                    }
                }

                return $this->render('schedule-edit', [
                    'model' => $this->findModel($this->_class->id),
                    'lessons' => $lessons,
                    'show_message' => $check,
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

    private function removeLessonFromSchedule($post = [])
    {
        $lesson = ClassLessonsSchedule::findOne([
            'class_id' => $this->_class->id,
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
