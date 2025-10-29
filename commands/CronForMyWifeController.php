<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
	use yii\console\{Controller, ExitCode};
	use app\models\{User, MyFutureCronTabs, MyEvents};
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
class CronForMyWifeController extends Controller
{

    private $telegram_IDs = ['395397316', '383208161']; # 395397316 - Віталя Лайф, 383208161 - Вікуся Лайф
    private $botApiToken = '833966489:AAHFPvTSoTLhyN3Ztax9l19ZDL_0_EEzTBg';
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

    	$cronTabsBirthdays_model = MyFutureCronTabs::find()->all();

    	if ($cronTabsBirthdays_model)
        {
            foreach($cronTabsBirthdays_model as $key => $record) :
                if ($unixtimestamp - $record->time >= $needed_time)
                {
                    $record->delete();
                }
            endforeach;
        }

    	return ExitCode::OK;
    }

    public function actionEvent()
    {
        $events_array = MyEvents::find()->select('id, time, event')->asArray()->all();
        
        $curl = new Curl();
        $unixtimestamp = time();
        foreach($events_array as $key => $value) :
            $result = myDateDiff($value['time'], $unixtimestamp);
            if ($result == '0')  {
                $check = MyFutureCronTabs::findOne(['event_id' => $value['id'], 'type_of_record' => 'today']);
                if (!$check)
                {
                    $event = $value['event'];
                    $event_time = $value['time'];
                    $cronFutureTabs_model = new MyFutureCronTabs();
                    $cronFutureTabs_model->event_id = $value['id'];
                    $cronFutureTabs_model->type_of_record = 'today';
                    $cronFutureTabs_model->event_time = $event_time;
                    $cronFutureTabs_model->time = $unixtimestamp;

                    if ($cronFutureTabs_model->save())
                    {
                        $__text = urlencode("🎂🎉 <b>" . myDateOfBirthdayOfThisYear('ua', $event_time) . "</b> 🎂🎉\n\n<i>" . $event . " (" . age($event_time) . ")</i>.\n\nТехнічна підтримка <b>Chernysh Family</b> ©");

                        foreach($this->telegram_IDs as $ti_key => $telegram_id) :
                            $response = $curl->get('https://api.telegram.org/bot' . $this->botApiToken . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                        endforeach;
                    }
                }
            }
        endforeach;

        return ExitCode::OK;
    }

    public function actionFutureEvent()
    {

        $events_array = MyEvents::find()->select('id, time, event')->asArray()->all();
        
        $curl = new Curl();
        $unixtimestamp = time();
        foreach($events_array as $key => $value) :
            $result = myDateDiff($value['time'], $unixtimestamp);
            if ($result <= -1 && $result >= -3) {
                $check = MyFutureCronTabs::findOne(['event_id' => $value['id'], 'type_of_record' => 'future']);
                if (!$check)
                {
                    $event = $value['event'];
                    $event_time = $value['time'];
                    $cronFutureTabs_model = new MyFutureCronTabs();
                    $cronFutureTabs_model->event_id = $value['id'];
                    $cronFutureTabs_model->type_of_record = 'future';
                    $cronFutureTabs_model->event_time = $event_time;
                    $cronFutureTabs_model->time = $unixtimestamp;
                    if ($cronFutureTabs_model->save())
                    {
                        $when = checkDaysString(myDateDiff($event_time, $unixtimestamp, '%a'));
                        
                        $__text = urlencode("Через " . $when . " (<b>" . myDateOfBirthdayOfThisYear('ua', $event_time) . "</b>)\n\n<i>" . $event . "</i>.\n\nТехнічна підтримка <b>Chernysh Family</b> ©");

                        foreach($this->telegram_IDs as $ti_key => $telegram_id) :
                            $response = $curl->get('https://api.telegram.org/bot' . $this->botApiToken . '/sendMessage?text=' . $__text . '&chat_id=' . $telegram_id . '&parse_mode=HTML');
                        endforeach;
                    }
                }
            }
        endforeach;

        return ExitCode::OK;
    }
}