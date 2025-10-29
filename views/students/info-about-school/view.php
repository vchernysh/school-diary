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

    <?php if (!$model->info) { ?>
        <i class="not-set">Інформація про дану школу відсутня. Заповнити її може лише директор. Очікуйте.</i>
    <?php } else { ?>
    	<?= $model->info; ?>
    <?php } ?>

</div>
