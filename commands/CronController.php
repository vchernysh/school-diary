<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
	use yii\console\{Controller, ExitCode};
	use app\models\{User, CronTabsBirthdays, BlockedIP, CronTabsNextPayment};
	use linslin\yii2\curl\Curl;


require_once(__DIR__ . '/../my_functions.php');


/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CronController extends Controller
{

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {

        return ExitCode::OK;
    }

    public function actionRemoveUnnecessaryRecords()
    {

    	$needed_time = 60*60*24*2;

    	$unixtimestamp = time();

    	$cronTabsBirthdays_model = CronTabsBirthdays::find()->all();

    	if ($cronTabsBirthdays_model)
        {
            foreach($cronTabsBirthdays_model as $key => $record) :
                if ($unixtimestamp - $record->time >= $needed_time)
                {
                    $record->delete();
                }
            endforeach;
        }

        $cronTabsNextPayment_model = CronTabsNextPayment::find()->all();

        if ($cronTabsNextPayment_model)
        {
            foreach($cronTabsNextPayment_model as $key => $record) :
                if ($unixtimestamp - $record->time >= $needed_time)
                {
                    $record->delete();
                }
            endforeach;
        }

    	$blockedIP_model = BlockedIP::find()->all();

    	if ($blockedIP_model)
    	{
    		foreach($blockedIP_model as $key => $record) :
	    		if ($unixtimestamp >= $record->time)
	    		{
	    			$record->delete();
	    		}
	    	endforeach;
    	}

    	return ExitCode::OK;
    }

    public function actionUserBirthday()
    {
        $birthdays_array = User::find()->select('id, type, birthday')->asArray()->where(['IS NOT', 'birthday', NULL])->all();
        
        $curl = new Curl();
        $unixtimestamp = time();
        foreach($birthdays_array as $key => $value) :
            $result = myDateDiff($value['birthday'], $unixtimestamp);
            if ($result == '0')  {
                $check = CronTabsBirthdays::findOne(['user_id' => $value['id'], 'type_of_record' => 'today']);
                if (!$check)
                {
                    $birthday = $value['birthday'];
                    $cronTabsBirthdays_model = new CronTabsBirthdays();
                    $cronTabsBirthdays_model->user_id = $value['id'];
                    $cronTabsBirthdays_model->type_of_record = 'today';
                    $cronTabsBirthdays_model->birthday = $birthday;
                    $cronTabsBirthdays_model->time = $unixtimestamp;

                    if ($cronTabsBirthdays_model->save())
                    {
                        $user = User::findOne($value['id']);
                        $name = $user->name;
                        $users = User::getAllUsersBySchool($value['id'], $value['type']);
                        $students = $users['students'];
                        $teachers = $users['teachers'];
                        $parents  = $users['parents'];
                        $director = $users['director'];
                        if ($value['type'] == 'student')
                        {
                            $__text = urlencode("Сьогодні день народження у <b>" . $name . "</b> (" . age($birthday) . ").\nНе забудьте привітати 🎂🎉.\n\nТехнічна підтримка <b>School Diary</b> ©");
                            if ($students)
                            {
                                $students_telegram_IDs = [];
                                foreach($students as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $students_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($students_telegram_IDs)
                                {
                                    foreach($students_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }

                            if ($teachers)
                            {
                                $teachers_telegram_IDs = [];
                                foreach($teachers as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $teachers_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($teachers_telegram_IDs)
                                {
                                    foreach($teachers_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotTeachersToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($parents)
                            {
                                $parents_telegram_IDs = [];
                                foreach($parents as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $parents_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($parents_telegram_IDs)
                                {
                                    foreach($parents_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                        } elseif ($value['type'] == 'director')
                        {
                            $__text = urlencode("Сьогодні день народження у директора — <b>" . $name . "</b> (" . age($birthday) . ").\nНе забудьте привітати 🎂🎉.\n\nТехнічна підтримка <b>School Diary</b> ©");

                            if ($students)
                            {
                                $students_telegram_IDs = [];
                                foreach($students as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $students_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($students_telegram_IDs)
                                {
                                    foreach($students_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($teachers)
                            {
                                $teachers_telegram_IDs = [];
                                foreach($teachers as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $teachers_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($teachers_telegram_IDs)
                                {
                                    foreach($teachers_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotTeachersToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($parents)
                            {
                                $parents_telegram_IDs = [];
                                foreach($parents as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $parents_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;

                                if ($parents_telegram_IDs)
                                {
                                    foreach($parents_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                        } elseif ($value['type'] == 'teacher')
                        {
                            $__text = urlencode("Сьогодні день народження у вчителя — <b>" . $name . "</b> (" . age($birthday) . ").\nНе забудьте привітати 🎂🎉.\n\nТехнічна підтримка <b>School Diary</b> ©");
                            if ($students)
                            {
                                $students_telegram_IDs = [];
                                foreach($students as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $students_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($students_telegram_IDs)
                                {
                                    foreach($students_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($teachers)
                            {
                                $teachers_telegram_IDs = [];
                                foreach($teachers as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $teachers_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($teachers_telegram_IDs)
                                {
                                    foreach($teachers_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotTeachersToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }

                            if ($parents)
                            {
                                $parents_telegram_IDs = [];
                                foreach($parents as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $parents_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($parents_telegram_IDs)
                                {
                                    foreach($parents_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                        }
                    }
                }
            }
        endforeach;

        return ExitCode::OK;
    }

    public function actionFutureBirthday()
    {
        
        $birthdays_array = User::find()->select('id, type, birthday')->asArray()->where(['IS NOT', 'birthday', NULL])->all();
        
        $curl = new Curl();
        $unixtimestamp = time();
        foreach($birthdays_array as $key => $value) :
            $result = myDateDiff($value['birthday'], $unixtimestamp);
            if ($result <= -1 && $result >= -3) {
                $check = CronTabsBirthdays::findOne(['user_id' => $value['id'], 'type_of_record' => 'future']);
                if (!$check)
                {
                    $birthday = $value['birthday'];
                    $next_birthday = age($birthday, false)+1;
                    $cronTabsBirthdays_model = new CronTabsBirthdays();
                    $cronTabsBirthdays_model->user_id = $value['id'];
                    $cronTabsBirthdays_model->type_of_record = 'future';
                    $cronTabsBirthdays_model->birthday = $birthday;
                    $cronTabsBirthdays_model->time = $unixtimestamp;
                    if ($cronTabsBirthdays_model->save())
                    {
                        $when = checkDaysString(myDateDiff($birthday, $unixtimestamp, '%a'));
                        $user = User::findOne($value['id']);
                        $name = $user->name;
                        $users = User::getAllUsersBySchool($value['id'], $value['type']);
                        $students = $users['students'];
                        $teachers = $users['teachers'];
                        $parents  = $users['parents'];
                        $director = $users['director'];
                        
                        if ($value['type'] == 'student')
                        {
                            $__text = urlencode("Через " . $when . " (" . myDateOfBirthdayOfThisYear('ua', $birthday) . ") день народження у <b>" . $name . "</b> (" . age($birthday, false) . " > " . $next_birthday . ").\nНе забудьте привітати 🎂🎉.\n\nТехнічна підтримка <b>School Diary</b> ©");
                            if ($students)
                            {
                                $students_telegram_IDs = [];
                                foreach($students as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $students_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($students_telegram_IDs)
                                {
                                    foreach($students_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($teachers)
                            {
                                $teachers_telegram_IDs = [];
                                foreach($teachers as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $teachers_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;

                                if ($teachers_telegram_IDs)
                                {
                                    foreach($teachers_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotTeachersToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($parents)
                            {
                                $parents_telegram_IDs = [];
                                foreach($parents as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $parents_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($parents_telegram_IDs)
                                {
                                    foreach($parents_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }

                        } elseif ($value['type'] == 'director')
                        {
                            $__text = urlencode("Через " . $when . " (" . myDateOfBirthdayOfThisYear('ua', $birthday) . ") день народження у директора — <b>" . $name . "</b> (" . age($birthday, false) . " > " . $next_birthday . ").\nНе забудьте привітати 🎂🎉.\n\nТехнічна підтримка <b>School Diary</b> ©");
                            if ($students)
                            {
                                $students_telegram_IDs = [];
                                foreach($students as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $students_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($students_telegram_IDs)
                                {
                                    foreach($students_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($teachers)
                            {
                                $teachers_telegram_IDs = [];
                                foreach($teachers as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $teachers_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($teachers_telegram_IDs)
                                {
                                    foreach($teachers_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotTeachersToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($parents)
                            {
                                $parents_telegram_IDs = [];
                                foreach($parents as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $parents_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($parents_telegram_IDs)
                                {
                                    foreach($parents_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                        } elseif ($value['type'] == 'teacher')
                        {
                            $__text = urlencode("Через " . $when . " (" . myDateOfBirthdayOfThisYear('ua', $birthday) . ") день народження у вчителя — <b>" . $name . "</b> (" . age($birthday, false) . " > " . $next_birthday . ").\nНе забудьте привітати 🎂🎉.\n\nТехнічна підтримка <b>School Diary</b> ©");
                            if ($students)
                            {
                                $students_telegram_IDs = [];
                                foreach($students as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $students_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($students_telegram_IDs)
                                {
                                    foreach($students_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($teachers)
                            {
                                $teachers_telegram_IDs = [];
                                foreach($teachers as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $teachers_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($teachers_telegram_IDs)
                                {
                                    foreach($teachers_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotTeachersToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                            if ($parents)
                            {
                                $parents_telegram_IDs = [];
                                foreach($parents as $k => $v) :
                                    $telegram_id = User::findOne($v)->telegram->telegram_chat_id;
                                    if ($telegram_id)
                                    {
                                        $parents_telegram_IDs[$v] = $telegram_id;
                                    }
                                endforeach;
                                if ($parents_telegram_IDs)
                                {
                                    foreach($parents_telegram_IDs as $kk => $telegram_id) :
                                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotParentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                                    endforeach;
                                }
                            }
                        }
                    }
                }
            }
        endforeach;

        return ExitCode::OK;
    }

    public function actionFutureNextPayment()
    {

        $unixtimestamp = time();
        $unixtimestampToNextPayment = getDateOfNextYearIfThisDayHasNotPass('01-06');
        $result = myDateDiff($unixtimestampToNextPayment, $unixtimestamp);

        if ($result <= -1 && $result >= -10)
        {   
            $when = checkDaysString(myDateDiff($unixtimestampToNextPayment, $unixtimestamp, '%a'));
            $date = myDate('ua', $unixtimestampToNextPayment);
            $curl = new Curl();
            $users_array = User::find()->select('id, name, type, email')->asArray()->where(['type' => ['parent', 'student']])->all();
            foreach($users_array as $key => $value) :
                $user_of_system = User::findOne($value['id']);
                $users_array[$key]['telegram_id'] = $user_of_system->telegram->telegram_chat_id;
                $users_array[$key]['price'] = $user_of_system->school->price;
                $users_array[$key]['currency'] = $user_of_system->school->currency->name;
                $users_array[$key]['is_test'] = $user_of_system->school->is_test;
            endforeach;
            foreach($users_array as $key => $user) :
                if ($user['is_test'] == 'no')
                {
                    $check = CronTabsNextPayment::findOne(['user_id' => $user['id'], 'type_of_record' => 'future_payment']);
                    if (!$check)
                    {
                        $cronTabsNextPayment_model = new CronTabsNextPayment();
                        $cronTabsNextPayment_model->user_id = $user['id'];
                        $cronTabsNextPayment_model->type_of_record = 'future_payment';
                        $cronTabsNextPayment_model->time = $unixtimestamp;
                        if ($cronTabsNextPayment_model->save())
                        {
                            if (!empty($user['telegram_id']))
                            {
                                $__text = urlencode("Через <b>" . $when . "</b> (<b>" . $date . "</b>) " .  "закінчується термін користування послугами електронної системи <b>School Diary</b>.\nЩоб продовжити користування послугами, вам необхідно мати <b>" . $user['price'] . $user['currency'] . "</b> та оплатити через сторінку на сайті, посилання якої буде доступне з <b>" . $date . "</b>:\n" . Url::to(['/payments'], true) . "\n\nТехнічна підтримка <b>School Diary</b> ©");
                                $telegram_token = '';
                                switch($user['type']) :
                                    case 'student' : $telegram_token = Yii::$app->params['telegramBotStudentsToken']; break;
                                    case 'parent' : $telegram_token = Yii::$app->params['telegramBotParentsToken']; break;
                                endswitch;
                                $response = $curl->get('https://api.telegram.org/bot' . $telegram_token . '/sendMessage?text=' . $__text . '&chat_id=' . $user['telegram_id'] . '&parse_mode=HTML');
                            }

                            $to   = $user['email'];
                            $from = Yii::$app->params['supportEmail'];

                            $mail = Yii::$app->mailer->compose('nextPayment', compact('user', 'when', 'date'))
                            ->setFrom([$from => 'Технічна підтримка School Diary'])
                            ->setTo($to)
                            ->setSubject('School Diary - Нагадування про наступну оплату за електронний журнал')
                            ->send();

                        }
                    }
                }
            endforeach;
        }

        return ExitCode::OK;
    }

    public function actionCurrentUserBirthday()
    {
        $birthdays_array = User::find()->select('id, name, type, email, birthday')->asArray()->where(['IS NOT', 'birthday', NULL])->all();
        
        $curl = new Curl();
        $unixtimestamp = time();
        foreach($birthdays_array as $key => $value) :
            $result = myDateDiff($value['birthday'], $unixtimestamp);
            if ($result == '0')  {
                $check = CronTabsBirthdays::findOne(['user_id' => $value['id'], 'type_of_record' => 'today']);

                $birthday = $value['birthday'];
                $user = User::findOne($value['id']);
                $name = $user->name;
                $telegram_id = $user->telegram->telegram_chat_id;

                if (!empty($telegram_id))
                {
                    $__text = urlencode("Вітаємо, <b>" . $name . "</b>! 🎂🎉 \nСьогодні у Вас день народження <b>(" . age($birthday) . ")</b>.\nБажаємо Вам всього найкращого і приємних емоцій.\n\nТехнічна підтримка <b>School Diary</b> ©");

                    if ($value['type'] == 'student')
                    {
                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                    } elseif ($value['type'] == 'director')
                    {
                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                    } elseif ($value['type'] == 'teacher')
                    {
                        $response = $curl->get('https://api.telegram.org/bot' . Yii::$app->params['telegramBotStudentsToken'] . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                    }
                }

                $to   = $user['email'];
                $from = Yii::$app->params['supportEmail'];

                $mail = Yii::$app->mailer->compose('birthday', compact('name', 'birthday'))
                    ->setFrom([$from => 'Технічна підтримка School Diary'])
                    ->setTo($to)
                    ->setSubject('З Днем Народження Вас!!!')
                    ->send();
            }
        endforeach;

        return ExitCode::OK;
    }
}