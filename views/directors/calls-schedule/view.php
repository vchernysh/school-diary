<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CallsSchedule */

$this->title = 'Дзвінок №: ' . $model->lesson_number;
$this->params['breadcrumbs'][] = ['label' => 'Розклад дзвінків', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="calls-schedule-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p class="class-for-paragraph-links">
        <?= Html::a('Додати новий дзвінок', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цей дзвінок?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                // 'school_id',
                'lesson_number',
                'start',
                'end',
                // 'break',
                [
                    'attribute' => 'break',
                    'format' => 'html',
                    'value' => function($data) {
                        if (!$data->break) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return $data->break;
                        }
                    },
                ],
            ],
        ]) ?>
    </div>

</div>
