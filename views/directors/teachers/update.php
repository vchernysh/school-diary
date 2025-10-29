<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = 'Змінити вчителя: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Учителі', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name . ' - ' . $model->subject, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="teachers-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'request' => $request,
    ]) ?>

</div>
