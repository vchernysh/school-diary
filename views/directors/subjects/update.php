<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Subjects */

$this->title = 'Змінити предмет: ' . $model->subject_name;
$this->params['breadcrumbs'][] = ['label' => 'Предмети', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="subjects-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
