<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InfoAboutSchool */

$this->title = 'Create Info About School';
$this->params['breadcrumbs'][] = ['label' => 'Info About Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-about-school-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
