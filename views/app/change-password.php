<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\{Html, Url};
use yii\bootstrap\ActiveForm;


?>
<div class="site-login">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-11\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label', 'style' => 'text-align: left;'],
        ],
    ]); ?>

        <?= $form->field($model, 'old_password')->passwordInput(['autofocus' => true, 'placeholder' => 'Старий пароль'])->label('Старий пароль') ?>

        <?= $form->field($model, 'new_password')->passwordInput(['placeholder' => 'Новий пароль'])->label('Новий пароль') ?>
        
        <?= $form->field($model, 're_password')->passwordInput(['placeholder' => 'Повторіть новий пароль'])->label('Повторіть новий пароль') ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
