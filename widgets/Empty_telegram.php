<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class Empty_telegram extends Widget // Widget for users which don't have telegram id in system;
{

    public function init()
    {
        parent::init();

        echo '<div id="empty_telegram_id">
            <div class="container">
                <img src="/images/telegram_logo.png" alt="Telegram logo" class="img-responsive telegram_logo">
                <p>У системі <b>School Diary</b> не зареєстрований Ваш <b>Telegram ID</b>. Щоб зареєструвати, перейдіть за посиланням і слідуйте інструкціям: <br><a href="' . Url::to(['/empty-telegram-id']) . '">' . Url::to(['/empty-telegram-id'], true) . '</a></p>
            </div>
        </div>';

    }
    
    public function run()
    {
        return parent::run();
    }

}
