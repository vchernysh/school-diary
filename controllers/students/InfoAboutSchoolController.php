<?php

namespace app\controllers\students;

use Yii;
use app\models\InfoAboutSchool;
use yii\data\ActiveDataProvider;
use app\controllers\StudentsController as StudentCONTROLLER;
use yii\web\NotFoundHttpException;

/**
 * InfoAboutSchoolController implements the CRUD actions for InfoAboutSchool model.
 */
class InfoAboutSchoolController extends StudentCONTROLLER
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
     * Displays a single InfoAboutSchool model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        return $this->render('view', [
            'model' => $this->findModel($this->_school->id),
        ]);
    }

    /**
     * Finds the InfoAboutSchool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InfoAboutSchool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoAboutSchool::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
