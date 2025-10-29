<?php

namespace app\controllers\directors;

use Yii;
use app\models\InfoAboutSchool;
use app\controllers\DirectorsController;
use yii\web\NotFoundHttpException;

/**
 * InfoAboutSchoolController implements the CRUD actions for InfoAboutSchool model.
 */
class InfoAboutSchoolController extends DirectorsController
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
     * Updates an existing InfoAboutSchool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {   
        $model = $this->findModel($this->_school->id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                return $this->redirect(['view']);
            }
        }

        return $this->render('update', [
            'model' => $model,
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
