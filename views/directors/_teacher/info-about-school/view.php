<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InfoAboutSchool */

$this->title = $model->school->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<br><br>
<div class="info-about-school-view">

    <?= $model->info; ?>

</div>
