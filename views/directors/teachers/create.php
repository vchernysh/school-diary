<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = 'Додати вчителя';
$this->params['breadcrumbs'][] = ['label' => 'Учителі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'request' => $request,
    ]) ?>

</div>
