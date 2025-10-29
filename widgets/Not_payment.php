<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class Not_payment extends Widget // Widget for users which didn't pay for the usage of system;
{

    public function init()
    {
        parent::init();

        echo '<div id="empty_payment_widget">
            <div class="container">
                <p>Ви не сплатили кошти за користування електронним журналом <b>School Diary</b>. Щоб сплатити, перейдіть за посиланням: <br><a href="' . Url::to(['/payments']) . '">' . Url::to(['/payments'], true) . '</a></p>
            </div>
        </div>';

    }
    
    public function run()
    {
        return parent::run();
    }

}
