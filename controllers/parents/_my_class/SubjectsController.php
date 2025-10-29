<?php

namespace app\controllers\parents\_my_class;

use Yii;
use app\models\{Classes, ClassSubjects, ClassLessonsSchedule};
use app\controllers\ParentsController as ParentCONTROLLER;
use yii\web\NotFoundHttpException;

/**
 * SubjectsController implements the CRUD actions for Classes model.
 */
class SubjectsController extends ParentCONTROLLER
{

    public function init()
    {
        parent::init();

        if (!$this->__payment_check)
        {
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionSubjects()
    {
        if ($this->findModel($this->_class->id)->school_id == $this->_school->id) {

            $school_subjects = $this->findModel($this->_class->id)->allSchoolSubjects;
            $class_subjects = $this->findModel($this->_class->id)->classSubjects;
            
            return $this->render('subjects', [
                'model' => $this->findModel($this->_class->id),
                'subjects' => $school_subjects,
                'class_subjects' => $class_subjects,
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
