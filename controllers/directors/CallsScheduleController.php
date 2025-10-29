<?php

namespace app\controllers\directors;

use Yii;
use app\models\CallsSchedule;
use app\models\search\CallsScheduleSearch;
use app\controllers\DirectorsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CallsScheduleController implements the CRUD actions for CallsSchedule model.
 */
class CallsScheduleController extends DirectorsController
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
     * Lists all CallsSchedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CallsScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['calls_schedule.school_id' => $this->_school->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CallsSchedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if ($this->findModel($id)->school_id == $this->_school->id) {
            
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Creates a new CallsSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CallsSchedule();

        if ($model->load(Yii::$app->request->post())) {

            $model->school_id = $this->_school->id;

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CallsSchedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        if ($this->findModel($id)->school_id == $this->_school->id) {
            
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Deletes an existing CallsSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        if ($this->findModel($id)->school_id == $this->_school->id) {
            
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Finds the CallsSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CallsSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CallsSchedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
