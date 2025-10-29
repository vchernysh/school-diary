<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Parents */

$this->title = 'Змінити інформацію про: ' . $model->name . ' - ' . $model->custom_type;
$this->params['breadcrumbs'][] = ['label' => 'Мій клас - ' . Yii::$app->user->identity->class->name . ' (Батьки)', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name . ' - ' . $model->custom_type, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="parents-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'request' => $request,
        'students' => $students,
    ]) ?>

</div>
