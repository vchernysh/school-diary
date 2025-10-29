<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CallsSchedule */

$this->title = 'Змінити дзвінок №: ' . $model->lesson_number;
$this->params['breadcrumbs'][] = ['label' => 'Розклад дзвінків', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Дзвінок №: ' . $model->lesson_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="calls-schedule-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
