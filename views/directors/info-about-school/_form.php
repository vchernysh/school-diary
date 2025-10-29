<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\InfoAboutSchool */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-about-school-form">

    <div id="my_ckeditor_wrap">
        
        <span class="sd_help_block not-set">Текстовий редактор не працює на мобільних та планшетних пристроях. Скористайтеся ним, відкривши цю сторінку на великому екрані (ноутбук | комп'ютер).</span>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'info')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'editorOptions' => [
                    'language' => 'uk',
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                ],
            ]) ?>
        

        <div class="form-group">
            <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
