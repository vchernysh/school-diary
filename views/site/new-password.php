<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="site-login forgot-password-block-wrap">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label', 'style' => 'text-align: left;'],
        ],
    ]); ?>

        <?= $form->field($model, 'new_password')->passwordInput(['autofocus' => true, 'placeholder' => 'Новий пароль', 'autocomplete' => 'off'])->label('Новий пароль') ?>

        <?= $form->field($model, 're_password')->passwordInput(['placeholder' => 'Повторіть новий пароль', 'autocomplete' => 'off'])->label('Повторіть новий пароль') ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Зберегти новий пароль', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                <?= Html::a('Повернутися на головну сторінку', Yii::$app->homeUrl, ['class' => 'btn btn-primary']); ?>

            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>