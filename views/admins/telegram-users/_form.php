<?php

use yii\helpers\{Html, ArrayHelper};
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Telegram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="telegram-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->label('Користувач')->dropdownList(ArrayHelper::map($users, 'id', 'name'), ['prompt' => ['text' => 'Виберіть користувача', 'options'=> ['disabled' => true, 'selected' => true]]]) ?>

    <?= $form->field($model, 'telegram_chat_id')->textInput(['maxlength' => true, 'value' => $request['telegram_chat_id']]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Змінити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
