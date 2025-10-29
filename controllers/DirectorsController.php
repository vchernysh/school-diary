<?php

namespace app\controllers;

use Yii;
    use yii\helpers\Url;
    use app\models\{InfoAboutSchool, Schools};


class DirectorsController extends AppController
{

    protected $_school, $_class;
    public $_count_students;

    public function init()
    {

        parent::init();

        $this->_school = Yii::$app->user->identity->school; // School of teacher
        $this->_class = Yii::$app->user->identity->class; // Class of teacher
        $this->_count_students = Schools::getCountOfAllStudentsBySchool($this->_school->id); // Count students of school


        Url::remember();

        if (Yii::$app->user->isGuest || Yii::$app->user->identity->type != 'director')
        {
            throw new \yii\web\NotFoundHttpException();
        }

        // END public function init();
    }

    public function actionIndex()
    {
    // 	$birthdays_array = \app\models\User::find()->select('id, name, type, email, birthday')->asArray()->where(['IS NOT', 'birthday', NULL])->all();
        
    //     $curl = new \linslin\yii2\curl\Curl();
    //     $unixtimestamp = time();
    //     foreach($birthdays_array as $key => $value) :
    //         $result = myDateDiff($value['birthday'], $unixtimestamp);
    //         if ($result == '0')  {
    //             $check = \app\models\CronTabsBirthdays::findOne(['user_id' => $value['id'], 'type_of_record' => 'today']);

    //             $birthday = $value['birthday'];
    //             $user = \app\models\User::findOne($value['id']);
    //             $name = $user->name;
    //             $telegram_id = $user->telegram->telegram_chat_id;

    //             if (!empty($telegram_id))
    //             {
	   //              $__text = urlencode("Вітаємо, <b>" . $name . "</b>! 🎂🎉 \nСьогодні у Вас день народження <b>(" . age($birthday) . ")</b>.\nБажаємо Вам всього найкращого і приємних емоцій.\n\nТехнічна підтримка <b>School Diary</b> ©");

	   //              if ($value['type'] == 'student')
	   //              {
	   //                  $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
	   //              } elseif ($value['type'] == 'director')
	   //              {
	   //                  $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
	   //              } elseif ($value['type'] == 'teacher')
	   //              {
	   //                  $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
	   //              }
    //             }

				// $to   = $user['email'];
				// $from = Yii::$app->params['supportEmail'];

    //             $mail = Yii::$app->mailer->compose('birthday', compact('name', 'birthday'))
	   //              ->setFrom([$from => 'Технічна підтримка School Diary'])
	   //              ->setTo($to)
	   //              ->setSubject('З Днем Народження Вас!!!')
	   //              ->send();

    //         }
    //     endforeach;

    //     die;

        $this->setMeta('Директор школи');

        $school = InfoAboutSchool::findOne(['school_id' => $this->_school->id]);

        if (!$school['info']) {
            $school['info'] = '<i class="not-set">Інформація про дану школу відсутня. Щоб заповнити її, перейдіть за наступним посиланням: <a href="' . Url::to(['/directors/info-about-school/update']) . '">' . Url::base(true) . Url::to(['/directors/info-about-school/update']) . '</a></i>';
        }

        return $this->render('index', compact('school'));

        // END public function actionIndex();
    }

    // END class DirectorsController;
}
