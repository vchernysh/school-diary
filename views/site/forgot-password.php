<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<div class="site-login forgot-password-block-wrap">

    <h1><?= Html::encode($this->title) ?></h1>

  	<?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label', 'style' => 'text-align: left;'],
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'autocomplete' => 'off', 'placeholder' => 'Впишіть Ваш E-mail, щоб відновити пароль', 'value' => $request['email']]) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Надіслати лист', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                <?= Html::a('Повернутися на головну сторінку', Yii::$app->homeUrl, ['class' => 'btn btn-primary']); ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
