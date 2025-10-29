<?php

namespace app\controllers\admins;

use Yii;
use yii\helpers\{Url, Html};
use app\models\{Questions, Support};
use app\models\search\QuestionsSearch;
use app\controllers\AdminsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TechnicalSupportController implements the CRUD actions for Questions model.
 */
class TechnicalSupportController extends AdminsController
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
     * Lists all Questions models.
     * @return mixed
     */
    public function actionIndex()
    {
		$searchModel = new QuestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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

        $model = Support::find()->where(['question_id' => $this->findModel($id)->id])->orderBy('date ASC')->all();

        if (Yii::$app->request->isAjax) {

            if (Yii::$app->request->get('message')) {

                $support = new Support();

                $support->question_id = $id;
                $support->type_answer = 'support';
                $support->message = Html::encode(Yii::$app->request->get('message'));
                $support->date = time();

                if ($support->save()) {

                    $question = $this->findModel($id);


                    $data['message']      = $support->message;
                    $data['type_message'] = 'ID: ' . $id . ' - ' . $question->custom_type;

                    $to   = $question->user->email;
                    $from = Yii::$app->params['supportEmail'];

                    $mail = Yii::$app->mailer->compose('support', compact('data'))
                        ->setFrom([$from => 'Технічна підтримка School Diary (Відповідь з бесіди)'])
                        ->setTo($to)
                        ->setSubject('School Diary - Повідомлення з технічної підтримки');

                    $mail->send();

                    $telegram_token = Yii::$app->params['telegramBotAdminsToken'];
                    
                    switch($question->user->type) :
                        case 'admin'    : $telegram_token = Yii::$app->params['telegramBotAdminsToken']; break;
                        case 'teacher'  : $telegram_token = Yii::$app->params['telegramBotTeachersToken']; break;
                        case 'student'  : $telegram_token = Yii::$app->params['telegramBotStudentsToken']; break;
                        case 'parent'   : $telegram_token = Yii::$app->params['telegramBotParentsToken']; break;
                        case 'director' : $telegram_token = Yii::$app->params['telegramBotDirectorsToken']; break;
                    endswitch;

                    $user_telegram_id = $question->user->telegram->telegram_chat_id;

                    if ($user_telegram_id) {

                        $this->__text = urlencode("Вам надіслали відповідь з технічної підтримки: \n\n<b>Тип повідомлення</b>: <code>" . $question->custom_type . "</code> \n<b>ID повідомлення</b>: <code>" . $id . "</code> \n<b>Посилання на бесіду</b>: <a>" . Url::to(['/support/view', 'id' => $id], true) . "</a> \n\nЧас: <b>" . myTime('H', $support->date) . "</b> \nДата: <b>" . myDate('ua', $support->date) . "</b>\n\n<b>Повідомлення: </b> \n------------------------\n<code>" . $support->message . "</code>");

                        $response = $this->curl->get('https://api.telegram.org/bot' . $telegram_token . '/sendMessage?text=' . $this->__text . '&chat_id=' . $user_telegram_id . '&parse_mode=HTML');

                    }

                    $data = '
                        <div class="outgoing_msg">
                            <div class="outgoing_msg_img">
                                <img src="' . Url::to(['/images/administrator.png']) . '" alt="support">
                            </div>
                            <div class="sent_msg">
                                <p>' . nl2br($support->message) . '</p>
                                <span class="time_date">' . myTime('H', $support->date) . ' | ' . myDate('ua', $support->date) . ' | <i style="color:#000; font-style:normal;">' . $support->answer_type . '</i></span>
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

    public function actionAjaxStatus($id)
    {
        $model = $this->findModel($id);
        if ($model->status == 'closed') {
            $model->status = 'opened';
        } else {
            $model->status = 'closed';
        }
        
        if ($model->save()) {
        	return $this->redirect('index');
        }
    }

    public function actionStatus($id)
    {
        $model = $this->findModel($id);
        if ($model->status == 'closed') {
            $model->status = 'opened';
        } else {
            $model->status = 'closed';
        }
        $model->save();

        return $this->redirect(['view', 'id' => $id]);

    }

    /**
     * Deletes an existing Questions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Support::deleteAll(['question_id' => $id]);
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', '<strong>Успішно</strong>! Видалено діалог № <strong>"' . $id . '"</strong>.');        

        return $this->redirect(['index']);
    }

    public function actionDeleteAll()
    {
    	if (Yii::$app->request->post())
    	{
    		Support::deleteAll();
    		Questions::deleteAll();
	        Yii::$app->session->setFlash('success', '<strong>Успішно</strong>! Ви видалили <strong>Усі</strong> діалоги.');      
	        return $this->redirect(['index']);
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
