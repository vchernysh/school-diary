<?php

namespace app\controllers\directors;

use Yii;
use app\models\{Teachers, User};
use app\models\search\TeachersSearch;
use app\controllers\DirectorsController;
use yii\web\{Response, NotFoundHttpException};
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;


/**
 * TeachersController implements the CRUD actions for Teachers model.
 */
class TeachersController extends DirectorsController
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
     * Lists all Teachers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['teachers.school_id' => $this->_school->id])->orderBy(['user.name' => SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Teachers model.
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
     * Creates a new Teachers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Teachers();

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
            $user_model->type = 'teacher';

            if ($user_model->save()) {

                $model->user_id = Yii::$app->db->getLastInsertID();
                $model->school_id = $this->_school->id;
                $model->subject = $model->subject;

                if ($model->save()) {

                    Yii::$app->session->setFlash('success', 'Ви успішно додали вчителя <strong>' . $model->new_name . '</strong> до школи!');
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }
                
        }
        return $this->render('create', [
            'model' => $model,
            'request' => Yii::$app->request->post('Teachers'),
        ]);

    }

    /**
     * Updates an existing Teachers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        if ($this->findModel($id)->school->id == $this->_school->id) {

            $model = $this->findModel($id);

            $model->new_username = $model->username;
            $model->new_name = $model->name;
            $model->new_fio = $model->fio;
            $model->new_phone = $model->phone;
            $model->new_email = $model->email;
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
                $user_model->phone = $model->new_phone;
                $user_model->email = $model->new_email;
                $user_model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;

                if ($model->save()) {
                    if ($user_model->save()) {
                        return $this->redirect(['view', 'id' => $model->user_id]);
                    }
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Deletes an existing Teachers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

    	if ($this->findModel($id)->school_id == $this->_school->id && Yii::$app->user->identity->id !== $id && User::findOne($id)->type != 'admin') {

            $user_name = User::findOne(['id' => $id])->name;
            User::removeUser($id);
            Yii::$app->session->setFlash('success', 'Користувач <strong>"' . $user_name . '"</strong> успішно видалений з системи!');

            return $this->redirect(['index']);
        }
	    
	    throw new \yii\web\NotFoundHttpException();
    }

    /**
     * Finds the Teachers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teachers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teachers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
