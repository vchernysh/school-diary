<?php

namespace app\controllers\admins;

use Yii;
use app\models\Telegram;
use app\models\search\TelegramSearch;
use app\controllers\AdminsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TelegramUsersController implements the CRUD actions for Telegram model.
 */
class TelegramUsersController extends AdminsController
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
     * Lists all Telegram models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TelegramSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Telegram model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Telegram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Telegram();

        $users = [];
        $i = 0;
        foreach($model->users as $key => $value) :

            $users[$i]['id'] = $value->id;
            $users[$i]['name'] = $value->id . ' - ' . $value->username . ' - ' . $value->name;

            $i++;
        endforeach;

        if ($model->load(Yii::$app->request->post())) {

            $check = true;

            $telegram_check_exist = Telegram::findOne(['telegram_chat_id' => $model->telegram_chat_id]);
            $user_telegram_check_exist = Telegram::findOne(['user_id' => $model->user_id]);

            if ($telegram_check_exist) {
                $check = false;
                Yii::$app->session->setFlash('error', 'Даний Telegram Chat ID уже зареєстрований у системі!');
            }
            if ($user_telegram_check_exist) {
            	Yii::$app->session->setFlash('error', 'Telegram Chat ID даного користувача уже зареєстрований у системі!');
                $check = false;
            }

            if ($check && $model->save()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'users' => $users,
            'request' => Yii::$app->request->post('Telegram')
        ]);
    }

    /**
     * Updates an existing Telegram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $users = [];
		
		$users[0]['id'] = $model->user_id;
		$users[0]['name'] = $model->user_id . ' - ' . $model->username . ' - ' . $model->name;

        $i = 1;
        foreach($model->users as $key => $value) :

            $users[$i]['id'] = $value->id;
            $users[$i]['name'] = $value->id . ' - ' . $value->username . ' - ' . $value->name;

            $i++;
        endforeach;

        if ($model->load(Yii::$app->request->post())) {

            $check = true;

            $telegram_check_exist = Telegram::findOne(['telegram_chat_id' => $model->telegram_chat_id]);
            $user_telegram_check_exist = Telegram::findOne(['user_id' => $model->user_id]);

            if ($telegram_check_exist && $telegram_check_exist->telegram_chat_id != $model->telegram_chat_id) {
                $check = false;
                Yii::$app->session->setFlash('error', 'Даний Telegram Chat ID уже зареєстрований у системі!');
            }
            if ($user_telegram_check_exist && $user_telegram_check_exist->user_id != $model->user_id) {
            	Yii::$app->session->setFlash('error', 'Telegram Chat ID даного користувача уже зареєстрований у системі!');
                $check = false;
            }

            if ($check && $model->save()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'users' => $users,
        ]);
    }

    /**
     * Deletes an existing Telegram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $name = $this->findModel($id)->name;

        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', '<strong>Успішно</strong>! Видалено Telegram ID для користувача <strong>"' . $name . '"</strong>.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Telegram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Telegram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Telegram::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
