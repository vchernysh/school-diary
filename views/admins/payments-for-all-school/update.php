<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentsForAllSchool */

$this->title = 'Змінити оплату за всю школу: №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Оплата за всю школу', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Оплата №' . $model->id . ' - ' . $model->school->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="payments-for-all-school-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools
    ]) ?>

</div>
