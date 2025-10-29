<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Regions */

$this->title = 'Додати область';
$this->params['breadcrumbs'][] = ['label' => 'Області', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
