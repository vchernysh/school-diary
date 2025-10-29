<?php
namespace app\controllers;

use Yii;
    use app\models\Telegram;


class BotController extends AppController
{

    private $_hash = '$2y$13$LMJ2OWSqYRBarWclkWdtWeJxDvdSTmKaPjIL5HNLCdmUM3c0vSU7C';

    public function init()
    {

        parent::init();

        if (Yii::$app->user->isGuest || !Yii::$app->user->identity)
        {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function init();
    }

    public function actionSaveTelegramChatId()
    {

        $request = Yii::$app->request;

        $chat_id  = $request->get('telegram_chat_id');
        $hash     = $request->get('hash');
        $username = $request->get('username');

        if ($chat_id && $username && $hash && $hash == $this->_hash && $username == Yii::$app->user->identity->username) {

            $check_telegram_chat_id_exists = Telegram::findOne(['telegram_chat_id' => $chat_id]);
            if (!$check_telegram_chat_id_exists || $check_telegram_chat_id_exists->user_id == Yii::$app->user->identity->id) {

                $user_id = Yii::$app->user->identity->id;
                $user_telegram = Telegram::findOne(['user_id' => $user_id]);

                if (!$user_telegram && $user_id) {

                    $user = new Telegram();
                    $user->user_id = $user_id;
                    $user->telegram_chat_id = $chat_id;
                    $user->status = 'closed';
                    $user->save();
                    Yii::$app->controller->telegram_id = $chat_id;
                    Yii::$app->session->setFlash('success', 'Вітаю, <b>' . Yii::$app->user->identity->name . '</b>. Ваш Telegram ID "<b>' . Yii::$app->controller->telegram_id . '</b>" успішно збережено у системі <b>School Diary</b>!');
                    return $this->redirect(['/']);

                } elseif ($user_telegram && $user_id && $user_telegram->status == 'pending') {

                    $user_telegram->telegram_chat_id = $chat_id;
                    $user_telegram->status = 'closed';
                    $user_telegram->save();
                    Yii::$app->controller->telegram_id = $chat_id;
                    Yii::$app->session->setFlash('success', 'Вітаю, <b>' . Yii::$app->user->identity->name . '</b>. Ваш Telegram ID "<b>' . Yii::$app->controller->telegram_id . '</b>" успішно змінено у системі <b>School Diary</b>!');

                    return $this->redirect(['/']);
                
                } else {
                    throw new \yii\web\NotFoundHttpException();
                }

            } else {
                
                Yii::$app->session->setFlash('error', 'Помилка! Такий Telegram ID уже зареєстрований у системі <b>School Diary</b>!');

                    return $this->redirect(['/']);
            }

                

        } else {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function actionSaveTelegramChatId();
    }

    // END class BotController;
}