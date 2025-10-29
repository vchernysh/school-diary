<?php

use yii\helpers\{Html, ArrayHelper};
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="classes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => $request['name']]) ?>

    <?= $form->field($model, 'teacher_id')->dropdownList(ArrayHelper::map($teachers, 'id', 'name'), ['prompt' => ['text' => $teachers ? 'Виберіть класного керівника' : 'Немає вільних учителів', 'options'=> ['disabled' => true, 'selected' => $model->isNewRecord ? true : false, 'value' => $request['teacher_id']]]]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
