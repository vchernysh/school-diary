<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentsForAllSchool */

$this->title = 'Нова оплата за всю школу';
$this->params['breadcrumbs'][] = ['label' => 'Оплата за всю школу', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-for-all-school-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'schools' => $schools
    ]) ?>

</div>
