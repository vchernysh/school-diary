<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InfoAboutSchool */

$this->title = 'Змінити інформацію про: ' . $model->school->name;
$this->params['breadcrumbs'][] = ['label' => 'Змінити інформацію про: ' . $model->school->name, 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="info-about-school-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
