<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\{Html, Url};
use yii\bootstrap\ActiveForm;

?>
<div class="site-login forgot-password-block-wrap">
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email', 'autocomplete' => 'off'])->label('Email') ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль', 'autocomplete' => 'off'])->label('Пароль') ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\"><div class=\"switch\">{input}<span class=\"slider round\"></span></div> {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->label('Запам\'ятати мене', ['for' => false]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Увійти', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                <?= Html::a('Забули пароль?', Url::to(['/forgot-password']), ['class' => 'btn btn-primary']); ?>

            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
