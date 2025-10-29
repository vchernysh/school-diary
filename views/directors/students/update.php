<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = 'Змінити учня: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Учні', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name . ' - ' . $model->class->name, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="students-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'classes' => $classes,
    ]) ?>

</div>
