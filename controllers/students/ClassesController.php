<?php

namespace app\controllers\students;

use Yii;
use app\models\{Classes, Subjects};
use app\models\search\ClassesSearch;
use app\controllers\StudentsController as StudentCONTROLLER;
use yii\web\NotFoundHttpException;

/**
 * ClassesController implements the CRUD actions for Classes model.
 */
class ClassesController extends StudentCONTROLLER
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
        $searchModel = new ClassesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['classes.school_id' => $this->_school->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

    public function actionSchedule($id)
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

            return $this->render('schedule', [
                'model' => $this->findModel($id),
                'lessons' => $lessons,
                'show_message' => $check,
            ]);
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
