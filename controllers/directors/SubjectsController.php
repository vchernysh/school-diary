<?php

namespace app\controllers\directors;

use Yii;
use app\models\{Subjects, ClassSubjects, ClassTeachersSubjectsAccess, ClassLessonsSchedule};
use app\models\search\SubjectsSearch;
use app\controllers\DirectorsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubjectsController implements the CRUD actions for Subjects model.
 */
class SubjectsController extends DirectorsController
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
     * Lists all Subjects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['subjects.school_id' => $this->_school->id])->orderBy(['subjects.subject_name' => SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subjects model.
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
     * Creates a new Subjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subjects();

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
     * Updates an existing Subjects model.
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
     * Deletes an existing Subjects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    	if ($this->findModel($id)->school_id == $this->_school->id) {

    		ClassSubjects::deleteAll(['subject_id' => $id]);
    		ClassTeachersSubjectsAccess::deleteAll(['subject_id' => $id]);
    		ClassLessonsSchedule::deleteAll(['subject_id' => $id]);

    		$this->findModel($id)->delete();

        	return $this->redirect(['index']);

    	}

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Finds the Subjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subjects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
