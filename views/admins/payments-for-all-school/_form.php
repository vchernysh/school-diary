<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentsForAllSchool */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payments-for-all-school-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'school_id')->textInput() ?>
    <?= $form->field($model, 'school_id')->dropdownList($schools, 
        ['prompt' => [
            'text' => 'Виберіть школу',
            'options'=> ['disabled' => true, 'selected' => true]
        ], 
        'onchange' => 
            '$.post("/admins/payments-for-all-school/get-school-info?id='.'"+$(this).val(), function(data) {
                var response = JSON.parse(data);
                $("#paymentsforallschool-amount").val(response.amount);
                $("#paymentsforallschool-currency").val(response.currency);
            });',
        ]); ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_to')->widget(DatePicker::className(), [
            'name' => 'birthday',
            'options' => [
                'placeholder' => 'Виберіть дату закінчення договору',
                'value' => $model->isNewRecord ? '01-06-' . date('Y', getDateOfNextYearIfThisDayHasNotPass('01-06')) : date('d-m-Y', $model->unix_date_to)
            ],
            'pluginOptions' => [
                'format' => 'dd-mm-yyyy',
                'todayHighlight' => false,
                'autoclose' => true,
                'startDate' => "0d"
            ]
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
