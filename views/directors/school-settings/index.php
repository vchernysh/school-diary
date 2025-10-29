<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = Yii::$app->user->identity->school->name . ' (Налаштування)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-update">

    <div class="classes-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'name')->label('Назва школи')->textInput(['maxlength' => true]) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Змінити', ['class' => 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>


</div>
