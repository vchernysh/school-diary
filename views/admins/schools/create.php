<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Schools */

$this->title = 'Додати школу';
$this->params['breadcrumbs'][] = ['label' => 'Школи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'cities' => [],
        'directors' => [],
        'currencies' => $currencies
    ]) ?>

</div>
