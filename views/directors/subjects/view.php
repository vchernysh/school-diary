<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subjects */

$this->title = $model->subject_name;
$this->params['breadcrumbs'][] = ['label' => 'Предмети', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subjects-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p class="class-for-paragraph-links">
        <?= Html::a('Додати новий предмет', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цей предмет?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'subject_name',
            ],
        ]) ?>
    </div>

</div>
