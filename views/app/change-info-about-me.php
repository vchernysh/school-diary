<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\{Html, Url};
use yii\bootstrap\ActiveForm;


?>
<div class="site-login">

    <h1 class="h1-title"><?= Html::encode($this->title . ' - ' . $model->name) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-11\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label', 'style' => 'text-align: left;'],
        ],
    ]); ?>

        <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['placeholder' => 'Email']) ?>

        <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['autofocus' => true, 'placeholder' => 'Логін']) ?>

        <?php if (Yii::$app->user->identity->type != 'student' && Yii::$app->user->identity->type != 'parent') { ?>
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ім\'я']) ?>

            <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'placeholder' => 'П.І.Б. → Шевченко Т. Г.']) ?>
        <?php } ?>

        <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Телефон']) ?>

        <?= $form->field($model, 'send_mail')->checkbox([
            'template' => "<div class=\"\"><div class=\"switch ciam_switch\">{input}<span class=\"slider round\"></span></div> {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->label('Надсилати повідомлення на вашу пошту від технічної підтримки?', ['for' => false]) ?>

        <a href="<?= $model->image ?>" title="<?= $model->name ?>" class="fancybox" rel="gallery">
            <img src="<?= $model->image ?>" alt="<?= $model->username ?>" class="user_image">
        </a>
        
        <br>
        <br>

        <?= $form->field($model, 'img')->fileInput() ?>

        <?php if ($model->image != '/images/_no_user.png') : ?>

            <div class="form-group">
                <div class="col-lg-12">
                
                    <?= Html::submitButton('Видалити зображення', [
                        'class' => 'btn btn-danger', 
                        'name' => 'remove-image', 
                        'value' => 'remove',
                        'data' => [
                            'confirm' => 'Ви дійсно хочете видалити зображення?',
                            'method' => 'post',
                        ]]) ?>
                </div>
            </div>

        <?php endif; ?>

        <br>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success', 'name' => 'save-info', 'value' => 'save']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
