<?php

use yii\helpers\{Html, ArrayHelper};
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JqueryAsset;

$this->title = 'Додати нову оцінку';
$this->params['breadcrumbs'][] = ['label' => 'Оцінки <i class="fa fa-pencil" aria-hidden="true"></i>', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $class->name . ' - Оцінки - ' . $subject->subject_name, 'url' => ['marks', 'class_id' => $class_id, 'subject_id' => $subject_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="add-new-marks-form">

  	<code>• Щоб побачити список оцінок учнів, необхідно вибрати дату і натиснути на кнопку "Показати оцінки". Після цього виставити оцінки певним учням і натиснути кнопку "Зберегти оцінки".</code>
  	<br>
  	<code>• Щоб видалити колонку достатньо задати кожному учню значення "Без оцінки" у цій самій колонці.</code>
  	<br>

  <h1 class="h1-title"><?= Html::encode($subject->subject_name) ?> - додати оцінку</h1>

	<?php $form = ActiveForm::begin(['options' => ['class' => 'marks-form']]); ?>
	

	<?= Html::hiddenInput('subject_id', $subject_id, ['class' => 'adding-marks-subject-id']); ?>
	<?= Html::hiddenInput('class_id', $class_id, ['class' => 'adding-marks-class-id']); ?>

	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<?= $form->field($model, 'date')->widget(DatePicker::className(), [
		        'name' => 'date',
		        'options' => ['placeholder' => 'дд-мм-рррр', 'class' => 'date_for_adding_marks'],
		        'pluginOptions' => [
		          'format' => 'dd-mm-yyyy',
		          'todayHighlight' => true,
		          'autoclose' => true,
		          'endDate' => '0d',
		        ]
		    ]); ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		    <?= Html::button('Показати оцінки', ['class' => 'btn btn-primary show-marks-btn']) ?>
		</div>
	</div>


	<div class="sheet-adding-marks-wrap">
		
	</div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile('@web/js/dir_teach.js', ['depends' => [JqueryAsset::class]]); ?>