<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

        <?php $form = ActiveForm::begin(); ?>
        
        <?php if ($model->isNewRecord) { ?>
            <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => 'Email', 'value' => $request['email'], 'onkeyup' => 
                    'var str = $(this).val().replace(/@/g, "").replace(/\./g, "");
                    $("#user-username").val(str);']) ?>
        <?php } else { ?>
            <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => 'Email', 'value' => $request['email']]) ?>
        <?php } ?>
        

        <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' => 'Логін', 'value' => $request['username']]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Ім\'я', 'value' => $request['name']]) ?>

        <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'placeholder' => 'П.І.Б. → Шевченко Т. Г.', 'value' => $request['fio']]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Телефон', 'value' => $request['phone']]) ?>

        <?= $form->field($model, 'type')->dropdownList(['admin' => 'Адміністратор', 'student' => 'Учень', 'teacher' => 'Учитель', 'parent' => 'Батьки', 'director' => 'Директор'], ['value' => $request['type']], 
            ['prompt' => [
                'text' => 'Тип користувача',
                'options'=> ['disabled' => true, 'selected' => true]
            ]]); ?>

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
                'todayHighlight' => false,
                'autoclose' => true,
                'endDate' => "0d"
            ]
        ]); ?>

        <br>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
