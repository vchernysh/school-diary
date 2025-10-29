<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolStaff */

$this->title = 'Змінити інформацію про: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Персонал школи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name . ' - ' . $model->position, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="school-staff-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'request' => $request,
    ]) ?>

</div>
