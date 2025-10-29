<?php

use yii\helpers\{Html, ArrayHelper};
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Schools */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schools-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map($regions, 'id', 'name'), 
        ['prompt' => ['text' => 'Виберіть область', 'options'=> ['disabled' => true, 'selected' => true]],
        'onchange' => 
            '$.post("/admins/schools/get-cities?id='.'"+$(this).val(), function(data) {
                $("select#schools-city_id").html(data);
                $("select#schools-director_id").html("");
            });',
        ]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map($regions, 'id', 'name'), ['value' => $model->region->id, 
            'prompt' => ['text' => 'Виберіть область', 'options'=> ['disabled' => true, 'selected' => true]],
            'onchange' => 
                '$.post("/admins/schools/get-cities?id='.'"+$(this).val(), function(data) {
                    $("select#schools-city_id").html(data);
                    $("select#schools-director_id").html("");
                });',
            ]) ?>
    <?php } ?>
    
    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map($cities, 'id', 'name'),
            ['onchange' => 
                '$.post("/admins/schools/get-directors?id='.'"+$(this).val()+"&new=1", function(data) {
                    $("select#schools-director_id").html(data);
                });',
            ]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'city_id')->dropdownList(ArrayHelper::map($cities, 'id', 'name'),
            ['onchange' => 
                '$.post("/admins/schools/get-directors?id='.'"+$(this).val()+"&school_id=' . $model->id . '", function(data) {
                    $("select#schools-director_id").html(data);
                });',
            ]) ?>
    <?php } ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'school_currency_ID')->dropdownList(ArrayHelper::map($currencies, 'id', 'name')) ?>
    
    <?= $form->field($model, 'payment_for_school')->dropdownList(['single' => 'За кожного учня окремо', 'all' => 'За всю школу'], ['prompt' => ['text' => 'Виберіть, яким чином буде проходити оплата за школу', 'options'=> ['disabled' => true, 'selected' => true]],
		'onchange' => 
			'
			if ($(this).val() == "single") {
				$("#schools-price").attr({"disabled": false, "required": true});
				$("#schools-price_for_all_school, #schools-max_students").attr({"disabled": true, "required": false});
			} else if ($(this).val() == "all") {
				$("#schools-price").attr({"disabled": true, "required": false});
				$("#schools-price_for_all_school, #schools-max_students").attr({"disabled": false, "required": true});
			}']) ?>


    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'price')->label('Ціна за учня <i class="fa fa-dollar" aria-hidden="true"></i>')->textInput(['disabled' => true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'price')->label('Ціна за учня <i class="fa fa-dollar" aria-hidden="true"></i>')->textInput(['disabled' => ($model->payment_for_school == 'single') ? false : true, 'placeholder' => ($model->payment_for_school == 'single') ? $model->currency->symbol . number_format($model->price, 2, ',', ' ') : '']) ?>
    <?php } ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'price_for_all_school')->label('Ціна за всю школу <i class="fa fa-dollar" aria-hidden="true"></i>')->textInput(['disabled' => true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'price_for_all_school')->label('Ціна за всю школу <i class="fa fa-dollar" aria-hidden="true"></i>')->textInput(['disabled' => ($model->payment_for_school == 'all') ? false : true, 'placeholder' => ($model->payment_for_school == 'all') ? $model->currency->symbol . number_format($model->price_for_all_school, 0, ',', ' ') : '']) ?>
    <?php } ?>

    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($model, 'max_students')->label('Макс. кількість учнів <i class="fa fa-child" aria-hidden="true"></i><i class="fa fa-child" aria-hidden="true"></i>')->textInput(['disabled' => true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'max_students')->label('Макс. кількість учнів <i class="fa fa-child" aria-hidden="true"></i><i class="fa fa-child" aria-hidden="true"></i>')->textInput(['disabled' => ($model->payment_for_school == 'all') ? false : true, 'placeholder' => ($model->payment_for_school == 'all') ? number_format($model->max_students, 0, ',', ' ') : '']) ?>
    <?php } ?>

    <?= $form->field($model, 'is_test')->dropdownList(['no' => 'Ні', 'yes' => 'Так'], 
                ['prompt' => [
                    'text' => 'Тестовий варіант?',
                    'options'=> ['disabled' => true, 'selected' => true]
                ]]); ?>

    <?= $form->field($model, 'director_id')->dropdownList(ArrayHelper::map($directors, 'id', 'name'), ['value' => $model->director->id]) ?>

    <?php if ($model->isNewRecord || !$director_teacher) { ?>
        <?= $form->field($model, 'if_director_can_be_teacher')->dropdownList(['0' => 'Ні', '1' => 'Так'], 
                ['prompt' => [
                    'text' => 'Директор може бути вчителем?',
                    'options'=> ['disabled' => true, 'selected' => true]
                ], 'onchange' => 
                    '$.post("/admins/schools/get-subject-field?check='.'"+$(this).val(), function(response) {
                        if (response == 0) {
                            $("#subject").html(" ");
                        } else {
                            $("#subject").html(response);
                        }
                    });']); ?>

        <div id="subject"></div>
    <?php } else { ?>

        <?php if ($director_teacher) { ?>

            <?php $model->if_director_can_be_teacher = 1; ?>

            <?= $form->field($model, 'if_director_can_be_teacher')->dropdownList(['0' => 'Ні', '1' => 'Так'], 
                ['prompt' => [
                    'text' => 'Директор може бути вчителем?',
                    'options'=> ['disabled' => true]
                ], 'onchange' => 
                    '$.post("/admins/schools/get-subject-field?check='.'"+$(this).val(), function(response) {
                        if (response == 0) {
                            $("#subject").html(" ");
                        } else {
                            $("#subject").html(response);
                        }
                    });']); ?>

            <div id="subject">
                <div class="form-group field-schools-teacher_subject">
                    <label class="control-label" for="schools-teacher_subject">Предмет</label>
                    <input type="text" required="" id="schools-teacher_subject" class="form-control" name="Schools[teacher_subject]" value="<?= $director_teacher->subject ?>">
                    <div class="help-block"></div>
                </div>
            </div>

        <?php } ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
