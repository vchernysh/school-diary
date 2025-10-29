<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Questions;
use yii\bootstrap\{ActiveForm, Modal};

class Footer_questions_modal extends Widget // Widget for send question to administration of School Diary;
{

    public function init()
    {
        parent::init();
        
        $model = new Questions();

        Modal::begin([
            'header' => '<span style="color:#355263;">Технічна підтримка - School Diary</span>',
            'toggleButton' => [
                'label' => 'Написати в тех. підтримку журналу', 
                'class' => 'ask_a_question_to_administration btn pull-right',
            ],
        ]);

            $form = ActiveForm::begin([
                'id' => 'question-form',
                'layout' => 'horizontal',
                'action' => ['/question'],
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'col-lg-12 control-label question_labels'],
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-4',
                        'offset' => 'offset-sm-4',
                        'wrapper' => 'col-sm-12',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
            ]);

                echo $form->field($model, 'type_message')->dropdownList(
                    [
                        'error' => 'Повідомити про помилку',
                        'idea' => 'Ідеї та побажання',
                        'complaint' => 'Поскаржитися',
                        'other' => 'Інші запитання'
                    ]
                );

                echo $form->field($model, 'message')->textarea([
                    'rows' => '6',
                    'placeholder' => $model->getAttributeLabel('message'),
                    'resize' => false
                    ]);

                echo Html::submitButton('Надіслати лист в тех. підтримку', ['class' => 'btn btn-success', 'name' => 'send_message_to_administration']);

            ActiveForm::end();

        Modal::end();
    
    }
    
    public function run()
    {
        return parent::run();
    }

}
