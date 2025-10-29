<?php

namespace app\controllers\teachers\_my_class;

use Yii;
    use app\models\{Parents, Students, User, Questions, Support, Telegram, CronTabsBirthdays};
    use app\models\search\ParentsSearch;
    use app\controllers\TeachersController as TeacherCONTROLLER;
    use yii\web\{Response, NotFoundHttpException};
    use yii\widgets\ActiveForm;
    use yii\filters\VerbFilter;

/**
 * ParentsController implements the CRUD actions for Parents model.
 */
class ParentsController extends TeacherCONTROLLER
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

    /**
     * Lists all Parents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['classes.school_id' => $this->_school->id, 'classes.id' => $this->_class->id])->orderBy(['user.name' => SORT_ASC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parents model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

    	if ($this->findModel($id)->school->id == $this->_school->id && $this->findModel($id)->class->id == $this->_class->id) {


	    	$parent = [];

	    	switch ($this->findModel($id)->type) :
	    		case 'mother':
	    			$parent['info_about_parent'] = 'матір';
	    			$parent['label_parent'] = 'матері';
	    			break;
	    		case 'father':
	    			$parent['info_about_parent'] = 'батька';
	    			$parent['label_parent'] = 'батька';
	    			break;
	    		case 'sister':
	    			$parent['info_about_parent'] = 'сестру';
	    			$parent['label_parent'] = 'сестри';
	    			break;
	    		case 'brother':
	    			$parent['info_about_parent'] = 'брата';
	    			$parent['label_parent'] = 'брата';
	    			break;
	    		case 'grandmother':
	    			$parent['info_about_parent'] = 'бабусю';
	    			$parent['label_parent'] = 'бабусі';
	    			break;
	    		case 'grandfather':
	    			$parent['info_about_parent'] = 'дідуся';
	    			$parent['label_parent'] = 'дідуся';
	    			break;
	    	endswitch;

	        return $this->render('view', [
	            'model' => $this->findModel($id),
	            'parent' => $parent,
	        ]);

	    }

	    throw new \yii\web\NotFoundHttpException();

    }

    /**
     * Creates a new Parents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parents();

		$students = User::find()
            ->innerJoin('students', 'user.id = students.user_id')
            ->select(['user.id', 'user.name'])
            ->where(['students.class_id' => $this->_class->id])
            ->orderBy(['user.name' => SORT_ASC])
            ->all();

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
            $user_model->type = 'parent';

            if ($user_model->save()) {

                $model->user_id = Yii::$app->db->getLastInsertID();
                $model->type = $model->type;

                if ($model->save()) {

                    Yii::$app->session->setFlash('success', 'Ви успішно додали нового члена родини <strong>' . $model->new_name . '</strong> до школи!');
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }
        	
        }

        return $this->render('create', [
            'model' => $model,
            'request' => Yii::$app->request->post('Parents'),
            'students' => $students,

        ]);
    }

    /**
     * Updates an existing Parents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

    	if ($this->findModel($id)->school->id == $this->_school->id && $this->findModel($id)->class->id == $this->_class->id) {

    		$model = $this->findModel($id);

    		$model->new_username = $model->username;
            $model->new_name = $model->name;
            $model->new_fio = $model->fio;
            $model->new_phone = $model->phone;
            $model->new_email = $model->email;
            $model->birthday_string = ($model->user->birthday) ? date('d-m-Y', $model->user->birthday) : '';

    		$students = User::find()
	            ->innerJoin('students', 'user.id = students.user_id')
	            ->select(['user.id', 'user.name'])
                ->where(['students.class_id' => $this->_class->id])
                ->orderBy(['user.name' => SORT_ASC])
	            ->all();

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
	            'request' => Yii::$app->request->post('Parents'),
	            'students' => $students,
	        ]);

    	}
    
    	throw new \yii\web\NotFoundHttpException();

    }

    /**
     * Deletes an existing Parents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if ($this->findModel($id)->school->id == $this->_school->id && $this->findModel($id)->class->id == $this->_class->id && Yii::$app->user->identity->id !== $id && User::findOne($id)->type != 'admin') {

            $user_name = User::findOne(['id' => $id])->name;
            User::removeUser($id);
            Yii::$app->session->setFlash('success', 'Користувач <strong>"' . $user_name . '"</strong> успішно видалений з системи!');

            return $this->redirect(['index']);

        }
	    
	    throw new \yii\web\NotFoundHttpException();

    }

    /**
     * Finds the Parents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Parents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Parents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
