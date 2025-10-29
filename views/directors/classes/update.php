<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Змінити клас: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="classes-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'teachers' => $teachers,
        'request' => $request,
    ]) ?>

</div>
