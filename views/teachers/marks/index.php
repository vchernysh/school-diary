<?php 
	use yii\helpers\{Html, Url};
	use yii\bootstrap\ActiveForm;

	$this->title = 'Оцінки';
	$this->params['breadcrumbs'][] = ['label' => $this->title . ' <i class="fa fa-pencil" aria-hidden="true"></i>'];

?>

<div class="marks-index">
    <h1 class="h1-title"><?= Html::encode('Виберіть клас та предмет перед тим, як дивитися або поставити оцінки'); ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label', 'style' => 'text-align: left;'],
        ],
    ]); ?>
		<?= $form->field($model, 'classes')->label('Виберіть клас:')->dropdownList($classes, 
			['prompt' => ['text' => 'Виберіть клас', 'options'=> ['disabled' => true, 'selected' => true]],
			'onchange' => 
	            '$(".loading-subjects").html(\'<i class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true"></i>\');
	            $.post("/teachers/marks/get-class-subjects?id='.'"+$(this).val(), function(data) {
	                $("select#dynamicmodel-subjects").html(data);
	                $(".loading-subjects").html("");
	            });']); ?>

		<?= $form->field($model, 'subjects')->label('Виберіть предмет: <span class="loading-subjects"></span>')->dropdownList($subjects, ['prompt' => ['text' => 'Виберіть клас, щоб вибрати предмет', 'options'=> ['disabled' => true, 'selected' => true]]]); ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Поставити оцінку', ['class' => 'btn btn-success', 'name' => 'add-new-mark', 'value' => 'add']) ?>
                <?= Html::submitButton('Переглянути оцінки', ['class' => 'btn btn-primary', 'name' => 'get-marks-sheet', 'value' => 'get']) ?>

            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>