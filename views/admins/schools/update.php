<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Schools */

$this->title = 'Змінити школу: ' . $model->name . ' - місто ' . $model->city_name;
$this->params['breadcrumbs'][] = ['label' => 'Школи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="schools-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'cities' => $cities,
        'directors' => $directors,
        'director_teacher' => $director_teacher,
        'currencies' => $currencies
    ]) ?>

</div>
