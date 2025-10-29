<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Додати клас';
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'teachers' => $teachers,
        'request' => $request,
    ]) ?>

</div>
