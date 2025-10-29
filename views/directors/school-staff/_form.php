<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolStaff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="school-staff-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'id' => 'school-staff-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-11\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label', 'style' => 'text-align: left;'],
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => $request['name']]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'value' => $request['position']]) ?>

    <?php if ($model->isNewRecord) {
        $model->birthday_string = $request['birthday_string'];
    } else {
        $model->birthday_string = ($model->birthday) ? date('d-m-Y', $model->birthday) : '';
    } ?>

    <?= $form->field($model, 'birthday_string')->widget(DatePicker::className(), [
        'name' => 'birthday',
        'options' => ['placeholder' => 'Виберіть дату народження'],
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true,
            'autoclose' => true,
            'endDate' => "0d"
        ]
    ]); ?>

    <?php if (!$model->isNewRecord) { ?>
        <br>

        <a href="<?= $model->image ?>" title="<?= $model->name ?>" class="fancybox" rel="gallery">
            <img src="<?= $model->image ?>" alt="<?= $model->name ?>" class="user_image">
        </a>
        
        <br>
        <br>
    <?php } ?>

    <?= $form->field($model, 'img')->fileInput() ?>

    <?php if ($model->image != '/images/_no_user.png' && !$model->isNewRecord) : ?>

        <div class="form-group">
            <div class="col-lg-12">
            
                <?= Html::submitButton('Видалити зображення', [
                    'class' => 'btn btn-danger', 
                    'name' => 'remove-image', 
                    'value' => 'remove',
                    'data' => [
                        'confirm' => 'Ви дійсно хочете видалити зображення?',
                        'method' => 'post',
                    ]]) ?>
            </div>
        </div>

    <?php endif; ?>

    <br>

    <div class="form-group" style="margin-left:0; margin-right:0;">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
