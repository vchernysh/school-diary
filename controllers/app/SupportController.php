<?php

namespace app\controllers\app;

use Yii;
use yii\helpers\{Url, Html};
use app\models\{Questions, Support};
use app\models\search\QuestionsSearch;
use app\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SupportController implements the CRUD actions for Questions model.
 */
class SupportController extends AppController
{

	public function init()
    {

        parent::init();

        Url::remember();

        if (Yii::$app->user->isGuest || !Yii::$app->user->identity)
        {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function init();
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
     * Lists all Questions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['questions.user_id' => Yii::$app->user->identity->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Questions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if ($this->findModel($id)->user_id == Yii::$app->user->identity->id) {

            $model = Support::find()->where(['question_id' => $this->findModel($id)->id])->orderBy('date ASC')->all();

            if (Yii::$app->request->isAjax) {

                if (Yii::$app->request->get('message')) {

                    $support = new Support();

                    $support->question_id = $id;
                    $support->type_answer = 'user';
                    $support->message = Html::encode(Yii::$app->request->get('message'));
                    $support->date = time();

                    if ($support->save()) {

                        $question = $this->findModel($id);

                        $data['message']      = $support->message;
                        $data['type_message'] = 'ID: ' . $id . ' - ' . $question->custom_type;
                        $data['email']        = Yii::$app->user->identity->email;
                        $data['user_id']      = Yii::$app->user->identity->id;
                        $data['username']     = Yii::$app->user->identity->username;
                        $data['name']         = Yii::$app->user->identity->name;
                        $data['phone']        = Yii::$app->user->identity->phone;
                        $data['user_type']    = Yii::$app->user->identity->custom_type;
                        $data['region']       = Yii::$app->user->identity->region->name;
                        $data['city']         = Yii::$app->user->identity->city->name;
                        $data['school']       = Yii::$app->user->identity->school->name;
                        $data['telegram']     = Yii::$app->user->identity->telegram->telegram_chat_id;

                        $to   = Yii::$app->params['adminEmail'];
                        $from = Yii::$app->params['supportEmail'];

                        $mail =  Yii::$app->mailer->compose('mail', compact('data'))
                        ->setFrom([$from => 'Технічна підтримка School Diary (Бесіда)'])
                        ->setTo($to)
                        ->setSubject('School Diary - Повідомлення в технічну підтримку (бесіда)');

                        if ($mail->send()) {

                            $this->__text = urlencode("Вам надіслали повідомлення в технічну підтримку (<b>бесіда</b>): \n\n<b>Тип повідомлення</b>: <code>" . $question->custom_type . "</code> \n<b>ID повідомлення</b>: <code>" . $id . "</code> \n<b>Посилання на бесіду</b>: <a>" . Url::to(['/admins/technical-support/view', 'id' => $id], true) . "</a> \n\n<b>ID</b>: <code>" . Yii::$app->user->identity->id . "</code> \n<b>Логін</b>: <code>" . Yii::$app->user->identity->username . "</code> \n<b>Email</b>: " . Yii::$app->user->identity->email . " \n<b>Ім'я</b>: <code>" . Yii::$app->user->identity->name . "</code> \n<b>Телефон</b>: <a>" . Yii::$app->user->identity->phone . "</a> \n<b>Telegram ID</b>: <code>" . Yii::$app->user->identity->telegram->telegram_chat_id . "</code> \n<b>Тип користувача</b>: <code>" . Yii::$app->user->identity->custom_type . "</code> \n<b>Школа</b>: <code>" . Yii::$app->user->identity->school->name . "</code> \n<b>Місто</b>: <code>" . Yii::$app->user->identity->city->name . "</code> \n<b>Область</b>: <code>" . Yii::$app->user->identity->region->name . "</code> \n\nЧас: <b>" . myTime('H', $support->date) . "</b> \nДата: <b>" . myDate('ua', $support->date) . "</b>\n\n<b>Повідомлення: </b> \n------------------------\n<code>" . $support->message . "</code>");

                            $response = $this->curl->get('https://api.telegram.org/bot' . $this->__token_notification . '/sendMessage?text=' . $this->__text . '&chat_id=' . $this->__adminTelegramID . '&parse_mode=HTML');
                            
                        }

                        $data = '
                            <div class="outgoing_msg">
                                <div class="outgoing_msg_img">
                                <img src="' . Url::to([Yii::$app->user->identity->image]) . '" alt="' . Yii::$app->user->identity->username . '">
                                </div>
                                <div class="sent_msg">
                                    <p>' . nl2br($support->message) . '</p>
                                    <span class="time_date">' . myTime('H', $support->date) . ' | ' . myDate('ua', $support->date) . '</span>
                                </div>
                            </div>
                        ';

                    }

                } else {
                    $data = '';
                }

            	return $data;

		    }

            return $this->render('view', [
                'model' => $model,
                'type' => $this->findModel($id)->custom_type,
                'question' => $this->findModel($id),
            ]);

        }

        throw new \yii\web\NotFoundHttpException();
        
    }

    /**
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
