<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Parents */

$this->title = 'Додати нового члена родини';
$this->params['breadcrumbs'][] = ['label' => 'Батьки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parents-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'request' => $request,
        'students' => $students,
    ]) ?>

</div>
