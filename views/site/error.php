<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= 'Сторінка ' . code(this_page()) . ' не знайдена на цьому сервері.' ?>
    </div>

    <?= Html::a('Повернутися на головну сторінку', Yii::$app->homeUrl, ['class' => 'btn btn-primary']); ?>
		
</div>
