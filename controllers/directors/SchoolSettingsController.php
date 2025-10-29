<?php

namespace app\controllers\directors;

use Yii;
use app\models\Schools;
use app\controllers\DirectorsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SchoolSettingsController implements the CRUD actions for Classes model.
 */
class SchoolSettingsController extends DirectorsController
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

    public function actionIndex()
    {

        $model = $this->findModel($this->_school->id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Налаштування збережені!');
                return $this->refresh();
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);

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
        if (($model = Schools::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
