<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = 'Змінити учня';
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $class->name, 'url' => ['view', 'id' => $class->id]];
$this->params['breadcrumbs'][] = ['label' => 'Учні - ' . $class->name, 'url' => ['students', 'class_id' => $class->id]];
$this->params['breadcrumbs'][] = ['label' =>  $model->new_name, 'url' => ['student', 'class_id' => $class->id, 'student_id' => $model->user_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="students-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_student_form', [
        'model' => $model,
    ]) ?>

</div>
