<?php

namespace app\controllers\parents\_my_class;

use Yii;
use app\models\{Classes, Subjects, ClassTeachersAccess, ClassTeachersSubjectsAccess};
use app\controllers\ParentsController as ParentCONTROLLER;
use yii\web\NotFoundHttpException;

/**
 * ScheduleController implements the CRUD actions for Classes model.
 */
class SettingsController extends ParentCONTROLLER
{

    public function init()
    {
        parent::init();

        if (!$this->__payment_check)
        {
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionIndex()
    {

        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {
            
            foreach ($this->findModel($this->_class->id)->classTeachersAccess as $teacher) :
                
                $subjects = [];
                $classTeachersSubjectsAccess = Subjects::find()
                    ->innerJoin('class_teachers_subjects_access', 'class_teachers_subjects_access.subject_id = subjects.id')
                    ->where([
                        'class_id' => $this->_class->id,
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

            $model = $this->findModel($this->_class->id);
            $model->teachers_subjects = $classTeachersAccess;

            return $this->render('index', [
                'model' => $model,
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
