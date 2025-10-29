<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RegionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Області';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати область', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{summary}\n{items}\n<div class='center-align'>{pager}</div>",
            'pager' => [
                'maxButtonCount' => 5,    // Set maximum number of page buttons that can be displayed
            ],
            'columns' => [
                // ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'count_cities',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'value' => function ($data) {
                        return $data->cities;
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'template' => '{view} {edit} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model) {
                            return Html::a('<i class="fa fa-trash-o control-label fa-school_diary" aria-hidden="true"></i>', ['delete', 'id' => $model->id], [
                                'class' => 'has-error',
                                'title' => 'Видалити',
                                'data' => [
                                    'confirm' => 'Ви дійсно хочете видалити "' . $model->name . '"?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                        'view' => function($url, $model) {
                            return Html::a('<i class="fa fa-eye control-label fa-school_diary" aria-hidden="true"></i>', ['view', 'id' => $model->id], [
                                'title' => 'Переглянути',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        },
                        'edit' => function($url, $model) {
                            return Html::a('<i class="fa fa-pencil control-label fa-school_diary" aria-hidden="true"></i>', ['update', 'id' => $model->id], [
                                'class' => 'has-warning',
                                'title' => 'Редагувати',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
