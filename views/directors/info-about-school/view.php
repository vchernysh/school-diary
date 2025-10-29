<?php

use yii\helpers\{Html, Url};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InfoAboutSchool */

$this->title = 'Змінити інформацію про: ' . $model->school->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-about-school-view">

    <p>
        <?= Html::a('Змінити', ['update'], ['class' => 'btn btn-primary']) ?>
    </p>
    <br>
    <br>

    <?php if (!$model->info) { ?>
        <i class="not-set">Інформація про дану школу відсутня. Щоб заповнити її, перейдіть за наступним посиланням: <a href="<?= Url::to(['/directors/info-about-school/update']); ?>"><?= Url::base(true) . Url::to(['/directors/info-about-school/update']); ?></a></i>
    <?php } else { ?>
    	<?= $model->info; ?>
    <?php } ?>

</div>
