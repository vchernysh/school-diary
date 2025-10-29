<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Змінити клас: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мій клас - ' . Yii::$app->user->identity->class->name . ' (Налаштування)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <div class="classes-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	    <div class="form-group">
	        <?= Html::submitButton('Змінити', ['class' => 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>


</div>
