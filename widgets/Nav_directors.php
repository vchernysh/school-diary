<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use yii\bootstrap\{NavBar, Nav};

class Nav_directors extends Widget // Widget for directors navigation;
{

    public function init()
    {
        parent::init();

        NavBar::begin([
            'brandLabel' => 'School Diary',
            'brandUrl' => Url::to(['/directors'], false),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

    	$__nav_not_teacher = Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Школа <i class="fa fa-university" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                        ['label' => 'Налаштування школи <i class="fa fa-gears" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/school-settings/index']],
                        ['label' => 'Учителі <i class="fa fa-graduation-cap" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/index']],
                        ['label' => 'Класи <i class="fa fa-group" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/classes/index']],
                        ['label' => 'Учні <i class="fa fa-child" aria-hidden="true"></i><i class="fa fa-child" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/students/index']],
                        ['label' => 'Батьки <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/parents/index']],
                        ['label' => 'Предмети <i class="fa fa-book" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/subjects/index']],
                        ['label' => 'Розклад дзвінків <i class="fa fa-bell-o" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/calls-schedule/index']],
                        ['label' => 'Персонал школи <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/school-staff/index']],
                        ['label' => 'Інформація про школу <i class="fa fa-info" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/info-about-school/view']],
                        // ['label' => 'Рейтинг класів <i class="fa fa-line-chart" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/class-rating/index']],
                        ['label' => 'Інформація про директора', 'url' => ['/info-about-director']],
                    ]],
                    ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                    ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                        ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                        ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                        ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                    ]],
                    ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']],
                ],
            ]);

    	$__nav_teacher = Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Школа <i class="fa fa-university" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'options' => ['class' => 'school_dropdown'], 'items' => [
                        
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">Директор</li>',
                        '<li class="divider"></li>',

                        ['label' => 'Налаштування школи <i class="fa fa-gears" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/school-settings/index']],
                        ['label' => 'Учителі <i class="fa fa-graduation-cap" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/index']],
                        ['label' => 'Класи <i class="fa fa-group" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/classes/index']],
                        ['label' => 'Учні <i class="fa fa-child" aria-hidden="true"></i><i class="fa fa-child" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/students/index']],
                        ['label' => 'Батьки <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/parents/index']],
                        ['label' => 'Предмети <i class="fa fa-book" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/subjects/index']],
                        ['label' => 'Розклад дзвінків <i class="fa fa-bell-o" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/calls-schedule/index']],
                        ['label' => 'Персонал школи <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/school-staff/index']],
                        ['label' => 'Інформація про школу <i class="fa fa-info" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/info-about-school/view']],
                        // ['label' => 'Рейтинг класів <i class="fa fa-line-chart" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/class-rating/index']],

                        '<li class="divider"></li>',
                        '<li class="dropdown-header">Учитель</li>',
                        '<li class="divider"></li>',
                        
                        ['label' => 'Список учителів', 'url' => ['/directors/teachers/teachers/index']],
                        ['label' => 'Список класів та розклад', 'url' => ['/directors/teachers/classes/index']],
                        ['label' => 'Список предметів школи', 'url' => ['/directors/teachers/subjects/index']],
                        ['label' => 'Розклад дзвінків', 'url' => ['/directors/teachers/calls-schedule/index']],
                        '<li class="divider"></li>',
                        ['label' => 'Персонал школи', 'url' => ['/directors/teachers/school-staff/index']],
                        ['label' => 'Інформація про школу', 'url' => ['/directors/teachers/info-about-school/view']],
                        ['label' => 'Інформація про директора', 'url' => ['/info-about-director']],
                    ]],
                    ['label' => 'Мій клас <i class="fa fa-graduation-cap" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [

                        ['label' => 'Налаштування <i class="fa fa-gears" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/my-class/settings/index']],
                        ['label' => 'Учні <i class="fa fa-child" aria-hidden="true"></i><i class="fa fa-child" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/my-class/students/index']],
                        ['label' => 'Батьки <i class="fa fa-users" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/my-class/parents/index']],
                        ['label' => 'Предмети <i class="fa fa-book" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/my-class/subjects']],
                        ['label' => 'Розклад <i class="fa fa-list-ul" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/my-class/schedule']],
                        ['label' => 'Успішність <i class="fa fa-line-chart" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/my-class/rating/index']],
                    ]],
                    ['label' => 'Оцінки <i class="fa fa-pencil" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/directors/teachers/marks/index']],
                    // ['label' => 'Технічна підтримка <span>(0)</span> <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                    ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                    // ['label' => 'Повідомлення <i class="fa fa-envelope" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    //     ['label' => 'Повідомлення для учнів', 'url' => ['/directors/teachers/message-for-students/index']],
                    //     ['label' => 'Повідомлення для батьків', 'url' => ['/directors/teachers/message-for-parents/index']],
                    //     ['label' => 'Домашні завдання', 'url' => ['/directors/teachers/homeworks/index']],
                    //     ['label' => 'Інші повідомлення', 'url' => ['/directors/teachers/other-messages/index']],
                    //     '<li class="divider"></li>',
                    //     ['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                    // ]],
                    ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                        ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                        ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                        ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                    ]],
                    ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']],
                ],
            ]);

		$__nav_not_paid = Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
            	['label' => 'Технічна підтримка <i class="fa fa-commenting" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/support/index']],
                ['label' => 'Профіль <i class="fa fa-user" aria-hidden="true"></i>', 'encode' => false, 'url' => ['#'], 'items' => [
                    ['label' => 'Переглянути інформацію про себе', 'url' => ['/about-me']],
                    ['label' => 'Змінити інформацію про себе', 'url' => ['/change-info-about-me']],
                    ['label' => 'Змінити пароль', 'url' => ['/change-password']],
                ]],
                ['label' => 'Вийти <i class="fa fa-sign-out" aria-hidden="true"></i>', 'encode' => false, 'url' => ['/logout']],
            ],
        ]);

        if (Yii::$app->controller->school__payment_type == 'all') {

        	if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time()))
	        {
	        	if (Yii::$app->controller->director_teacher) {
	        		echo $__nav_teacher;
		        } else {
		        	echo $__nav_not_teacher;
		        }
	        } else {
	        	echo $__nav_not_paid;
	        }
        } elseif (Yii::$app->controller->school__payment_type == 'single') {
        	
        	if (Yii::$app->controller->director_teacher) {
	            echo $__nav_teacher;
	        } else {
	            echo $__nav_not_teacher;
	        }
        }

        NavBar::end();
    
    }
    
    public function run()
    {
        return parent::run();
    }

}
