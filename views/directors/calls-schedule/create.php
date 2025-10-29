<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CallsSchedule */

$this->title = 'Додати новий дзвінок';
$this->params['breadcrumbs'][] = ['label' => 'Розклад дзвінків', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calls-schedule-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
