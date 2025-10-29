<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Parents */

$this->title = 'Додати нового члена родини';
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $class->name, 'url' => ['view', 'id' => $class->id]];
$this->params['breadcrumbs'][] = ['label' => 'Учні - ' . $class->name, 'url' => ['students', 'class_id' => $class->id]];
if ($student_model) {
	$this->params['breadcrumbs'][] = ['label' =>  $student_model->name, 'url' => ['student', 'class_id' => $class->id, 'student_id' => $student_model->user_id]];
	$this->params['breadcrumbs'][] = ['label' =>  'Батьки учня', 'url' => ['parents-of-student', 'student_id' => $student_model->user_id, 'class_id' => $class->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parents-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_parents_form', [
        'model' => $model,
        'request' => $request,
        'students' => $students,
    ]) ?>

</div>
