<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use yii\bootstrap\{NavBar, Nav};

class Nav_students extends Widget // Widget for students navigation;
{

    public function init()
    {
        parent::init();

        NavBar::begin([
            'brandLabel' => 'School Diary',
            'brandUrl' => Url::to(['/students'], false),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        $payments_divider = '';
        $payments_label = '';

        if (Yii::$app->user->identity->school->is_test == 'no') 
        {
            $payments_divider = '<li class="divider"></li>';
            $payments_label = ['label' => 'Оплата за журнал <img src="/images/visa-icon.png" title="Visa" alt="Visa" class="visa-img payment-nav-img"><img src="/images/mastercard-icon.png" alt="MasterCard" title="MasterCard" class="mastercard-img payment-nav-img">', 'encode' => false, 'options' => ['class' => 'nav-wrap-flex-li'], 'url' => ['/payments']];
        }


        $__nav_single_paid = Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Школа <i class="fa fa-university" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'options' => ['class' => 'school_dropdown'], 'items' => [
                    ['label' => 'Список учителів', 'url' => ['/students/teachers/index']],
                    ['label' => 'Список класів та розклад', 'url' => ['/students/classes/index']],
                    ['label' => 'Список предметів школи', 'url' => ['/students/subjects/index']],
                    ['label' => 'Розклад дзвінків', 'url' => ['/students/calls-schedule/index']],
                    '<li class="divider"></li>',
                    ['label' => 'Персонал школи', 'url' => ['/students/school-staff/index']],
                    ['label' => 'Інформація про школу', 'url' => ['/students/info-about-school/view']],
                    ['label' => 'Інформація про директора', 'url' => ['/info-about-director']],
                ]],
                ['label' => 'Мій клас <i class="fa fa-graduation-cap" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    ['label' => 'Налаштування <i class="fa fa-gears" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/settings/index']],
                    ['label' => 'Учні <i class="fa fa-child" aria-hidden="true"></i><i class="fa fa-child" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/students/index']],
                    ['label' => 'Батьки <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/parents/index']],
                    ['label' => 'Мої Батьки <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/my-parents/index']],
                    ['label' => 'Предмети <i class="fa fa-book" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/subjects']],
                    ['label' => 'Розклад <i class="fa fa-list-ul" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/schedule']],
                    ['label' => 'Успішність <i class="fa fa-line-chart" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/rating/index']],
                ]],
                // ['label' => 'Повідомлення від учителів <i class="fa fa-envelope" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                //     ['label' => 'Домашні завдання', 'url' => ['/students/new-homework']],
                //     ['label' => 'Інші повідомлення', 'url' => ['/students/other-messages']],
                // ]],
                ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                    ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                    ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                    $payments_divider,
                    $payments_label,
                ]],
                ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']]
            ],
        ]);
        $__nav_single_not_paid = Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Оплата за журнал <img src="/images/visa-icon.png" title="Visa" alt="Visa" class="visa-img payment-nav-img"><img src="/images/mastercard-icon.png" alt="MasterCard" title="MasterCard" class="mastercard-img payment-nav-img">', 'encode' => false, 'options' => ['class' => 'nav-wrap-flex-li unpaid-nav-li'], 'url' => ['/payments']],
                ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                    ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                    ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                ]],
                ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']]
            ],
        ]);
        $__nav_all_paid = Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Школа <i class="fa fa-university" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'options' => ['class' => 'school_dropdown'], 'items' => [
                    ['label' => 'Список учителів', 'url' => ['/students/teachers/index']],
                    ['label' => 'Список класів та розклад', 'url' => ['/students/classes/index']],
                    ['label' => 'Список предметів школи', 'url' => ['/students/subjects/index']],
                    ['label' => 'Розклад дзвінків', 'url' => ['/students/calls-schedule/index']],
                    '<li class="divider"></li>',
                    ['label' => 'Персонал школи', 'url' => ['/students/school-staff/index']],
                    ['label' => 'Інформація про школу', 'url' => ['/students/info-about-school/view']],
                    ['label' => 'Інформація про директора', 'url' => ['/info-about-director']],
                ]],
                ['label' => 'Мій клас <i class="fa fa-graduation-cap" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    ['label' => 'Налаштування <i class="fa fa-gears" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/settings/index']],
                    ['label' => 'Учні <i class="fa fa-child" aria-hidden="true"></i><i class="fa fa-child" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/students/index']],
                    ['label' => 'Батьки <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/parents/index']],
                    ['label' => 'Мої Батьки <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/my-parents/index']],
                    ['label' => 'Предмети <i class="fa fa-book" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/subjects']],
                    ['label' => 'Розклад <i class="fa fa-list-ul" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/schedule']],
                    ['label' => 'Успішність <i class="fa fa-line-chart" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/students/my-class/rating/index']],
                ]],
                // ['label' => 'Повідомлення від учителів <i class="fa fa-envelope" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                //     ['label' => 'Домашні завдання', 'url' => ['/students/new-homework']],
                //     ['label' => 'Інші повідомлення', 'url' => ['/students/other-messages']],
                // ]],
                ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                    ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                    ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                ]],
                ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']]
            ],
        ]);
        $__nav_all_not_paid = Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                    ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                    ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                ]],
                ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']]
            ],
        ]);

        if (Yii::$app->controller->school__payment_type == 'all') {
            if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time()))
            {
                echo $__nav_all_paid;
            } else {
                echo $__nav_all_not_paid;
            }
        } elseif (Yii::$app->controller->school__payment_type == 'single') {
            if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()))
            {
                echo $__nav_single_paid;
            } else {
                echo $__nav_single_not_paid;
            }
        }

        NavBar::end();
    
    }
    
    public function run()
    {
        return parent::run();
    }

}
