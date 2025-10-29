<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use yii\bootstrap\{NavBar, Nav};

class Nav_admins extends Widget // Widget for admins navigation;
{

    public function init()
    {
        parent::init();

        NavBar::begin([
            'brandLabel' => 'School Diary',
            'brandUrl' => Url::to(['/admins'], false),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [

                    ['label' => 'Користувачі <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/admins/users']],
                    ['label' => 'Система <i class="fa fa-gears" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                        ['label' => 'Області', 'url' => ['/admins/regions/index']],
                        ['label' => 'Міста', 'url' => ['/admins/cities/index']],
                        ['label' => 'Школи <i class="fa fa-university" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/admins/schools/index']],
                        ['label' => 'Валюти <i class="fa fa-eur" aria-hidden="true"></i> <i class="fa fa-usd" aria-hidden="true"></i>', 'encode' => false, 'options' => ['class' => 'nav-wrap-flex-li'], 'url' => ['/admins/currencies/index']],
                        ['label' => 'Користувачі Telegram <i class="fa fa-telegram" aria-hidden="true"></i>', 'encode' => false, 'options' => ['class' => 'nav-wrap-flex-li'], 'url' => ['/admins/telegram-users/index']],
                        ['label' => 'Питання в технічну підтримку <i class="fa fa-question" aria-hidden="true"></i><i class="fa fa-question" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/admins/technical-support/index']],
                        '<li class="divider"></li>',
                        ['label' => 'Оплата за журнал <img src="/images/visa-icon.png" title="Visa" alt="Visa" class="visa-img payment-nav-img"><img src="/images/mastercard-icon.png" alt="MasterCard" title="MasterCard" class="mastercard-img payment-nav-img">', 'encode' => false, 'options' => ['class' => 'nav-wrap-flex-li'], 'url' => ['/admins/payments/index']],
                        ['label' => 'Оплата за всю школу <img src="/images/visa-icon.png" title="Visa" alt="Visa" class="visa-img payment-nav-img"><img src="/images/mastercard-icon.png" alt="MasterCard" title="MasterCard" class="mastercard-img payment-nav-img">', 'encode' => false, 'options' => ['class' => 'nav-wrap-flex-li'], 'url' => ['/admins/payments-for-all-school/index']],
                    ]],
                    ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                    ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                        ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                        ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                        ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                    ]],
                    ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']]
                ],
            ]);

        NavBar::end();
    
    }
    
    public function run()
    {
        return parent::run();
    }

}
