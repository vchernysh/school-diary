<?php

use yii\helpers\{ArrayHelper, Html};
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Students */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'new_email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => 'Email', 'value' => $request['new_email'], 'onkeyup' => 
                'var str = $(this).val().replace(/@/g, "").replace(/\./g, "");
                $("#students-new_username").val(str);']) ?>
    <?php } else { ?>
        <?= $form->field($model, 'new_email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => 'Email', 'value' => $request['new_email']]) ?>
    <?php } ?>

    <?= $form->field($model, 'new_username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' => 'Логін', 'value' => $request['new_username']]) ?>

    <?= $form->field($model, 'new_name')->textInput(['maxlength' => true, 'placeholder' => 'Ім\'я', 'value' => $request['new_name']]) ?>

    <?= $form->field($model, 'new_fio')->textInput(['maxlength' => true, 'placeholder' => 'П.І.Б. → Шевченко Т. Г.', 'value' => $request['new_fio']]) ?>

    <?= $form->field($model, 'new_phone')->textInput(['maxlength' => true, 'placeholder' => 'Телефон', 'value' => $request['new_phone']]) ?>

    <?php if ($model->isNewRecord) {
        $model->birthday_string = $request['birthday_string'];
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

    <br>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
