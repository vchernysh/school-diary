<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SchoolStaff */

$this->title = 'Додати нового працівника';
$this->params['breadcrumbs'][] = ['label' => 'Персонал школи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-staff-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'request' => $request,
    ]) ?>

</div>
