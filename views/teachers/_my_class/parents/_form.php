<?php

use yii\helpers\{Html, ArrayHelper};
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Parents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'new_email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => 'Email', 'value' => $request['new_email'], 'onkeyup' => 
                'var str = $(this).val().replace(/@/g, "").replace(/\./g, "");
                $("#parents-new_username").val(str);']) ?>
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

    <?= $form->field($model, 'student_id')->dropdownList(ArrayHelper::map($students, 'id', 'name'), ['prompt' => ['text' => ($students) ? 'Виберіть учня' : 'Не зареєстровано жодного учня. Додайте хоча б одного.', 'options'=> ['disabled' => true, 'selected' => true]]]) ?>

    <?= $form->field($model, 'type')->dropdownList(['mother' => 'Мати', 'father' => 'Батько', 'sister' => 'Сестра', 'brother' => 'Брат', 'grandmother' => 'Бабуля', 'grandfather' => 'Дідуля'], 
            ['prompt' => [
                'text' => 'Тип користувача',
                'options'=> ['disabled' => true, 'selected' => true]
            ],
            'value' => $request['type']]); ?>


    <br>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
