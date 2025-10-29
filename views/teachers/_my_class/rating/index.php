<?php 
	use yii\helpers\{Html, Url};
	use yii\bootstrap\ActiveForm;

	$this->title = 'Оцінки';
	$this->params['breadcrumbs'][] = ['label' => 'Мій клас - ' . Yii::$app->user->identity->class->name . ' (Успішність <i class="fa fa-line-chart" aria-hidden="true"></i>)'];
?>

<div class="marks-index">

    <h1 class="h1-title"><?= Html::encode('Виберіть предмет перед тим, як дивитися або поставити оцінки'); ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label', 'style' => 'text-align: left;'],
        ],
    ]); ?>
		<?= $form->field($model, 'subjects')->label('Виберіть предмет:')->dropdownList($subjects, ['prompt' => ['text' => 'Виберіть предмет', 'options'=> ['disabled' => true, 'selected' => true]]]); ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Поставити оцінку', ['class' => 'btn btn-success', 'name' => 'add-new-mark', 'value' => 'add']) ?>
                <?= Html::submitButton('Переглянути оцінки', ['class' => 'btn btn-primary', 'name' => 'get-marks-sheet', 'value' => 'get']) ?>

            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>