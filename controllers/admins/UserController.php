<?php

namespace app\controllers\admins;

use Yii;
use app\models\{User, Cities, Schools, Classes, Directors, Teachers, Telegram};
use app\models\search\UserSearch;
use app\controllers\AdminsController;
use yii\web\{NotFoundHttpException, Response};
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AdminsController
{
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $user_type = '';
        switch ($this->findModel($id)->type) :
            
            case 'admin'    : $user_type = 'Адміністратор'; break;
            case 'teacher'  : $user_type = 'Учитель';       break;
            case 'student'  : $user_type = 'Учень';         break;
            case 'parent'   : $user_type = 'Батьки';        break;
            case 'director' : $user_type = 'Директор';      break;

        endswitch;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'user_type' => $user_type
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        $check = 1;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                   
           Yii::$app->response->format = Response::FORMAT_JSON;
           return ActiveForm::validate($model);
        
        } elseif (Yii::$app->request->isPost) {

            $check_username = User::find()->select(['id', 'username'])->where(['username' => Yii::$app->request->post('User')['username']])->one();
            $check_email = User::find()->select(['id', 'email'])->where(['email' => Yii::$app->request->post('User')['email']])->one();

            if (!empty($check_email)) {
                
                $check = 0;
                Yii::$app->session->setFlash('error', 'Даний Email уже зареєстрований у системі!');

            } elseif (!empty($check_username)) {

                $check = 0;
                Yii::$app->session->setFlash('error', 'Даний Логін уже зареєстрований у системі!');

            }

        }

        if ($check == 1) {

            if ($model->load(Yii::$app->request->post())) {

                $model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;

                $model->image = '/images/_no_user.png';
                $model->password = Yii::$app->getSecurity()->generatePasswordHash(12345);
                $model->real_password = '12345';

                // $forbidden_chars = '/[№#@!\"<>&\/?\`~":;=+()*&,.^%$»«\\\|{}\[\]]/i';
 
                // $model->username = preg_replace($forbidden_chars, '', $model->email);

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }

        }

        return $this->render('create', [
            'model' => $model,
            'request' => Yii::$app->request->post('User')
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                   
           Yii::$app->response->format = Response::FORMAT_JSON;
           return ActiveForm::validate($model);
        
        } elseif (Yii::$app->request->isPost) {

            $check = 1;

            $check_email = User::findOne(['email' => Yii::$app->request->post('User')['email']]);
            $check_username = User::findOne(['username' => Yii::$app->request->post('User')['username']]);

            if (!empty($check_email) && $check_email->email != $model->email) {
                $check = 0;
                Yii::$app->session->setFlash('error', 'Даний Email уже зареєстрований у системі!');
            } elseif (!empty($check_username) && $check_username->username != $model->username) {
                $check = 0;
                Yii::$app->session->setFlash('error', 'Даний Логін уже зареєстрований у системі!');
            }

            if ($check == 1) {

                if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
                   
                   Yii::$app->response->format = Response::FORMAT_JSON;
                   return ActiveForm::validate($model);
                
                } elseif ($model->load(Yii::$app->request->post())) {

                    $model->birthday = ($model->birthday_string) ? strtotime($model->birthday_string) : NULL;
                    
                    // $forbidden_chars = '/[№#@!\"<>&\/?\`~":;=+()*&,.^%$»«\\\|{}\[\]]/i';
                    // $model->username = preg_replace($forbidden_chars, '', $model->email);
                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    	$user_name = $this->findModel($id)->name;
        User::removeUser($id);
        Yii::$app->session->setFlash('success', 'Користувач "' . $user_name . '" успішно видалений з системи!');

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}