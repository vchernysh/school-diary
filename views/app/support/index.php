<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Технічна підтримка';
$this->params['breadcrumbs'][] = $this->title . ' <i class="fa fa-commenting" aria-hidden="true"></i>';
?>
<div class="questions-index">

    <h1 class="h1-title"><?= $this->title ?> <i class="fa fa-commenting" aria-hidden="true"></i></h1>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{summary}\n{items}\n<div class='center-align'>{pager}</div>",
            'pager' => [
                'maxButtonCount' => 5,    // Set maximum number of page buttons that can be displayed
            ],
            'columns' => [

                [
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'custom_type',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->type_message . '">' . $data->custom_type . '</span>';
                    }
                ],
                [
                    'attribute' => 'message',
                    'format' => 'ntext',
                    'headerOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return trunc_letters($data->message, 0, 55, true);
                    },
                ],
                [
                    'attribute' => 'custom_status',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->status . '">' . $data->custom_status . '</span>';
                    }
                ],
                [
                    'attribute' => 'count_answers',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'value' => function ($data) {
                        return $data->count_answers;
                    }
                ],
                [
                    'attribute' => 'date',
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'headerOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'format' => 'html',
                    'value' => function($data) {
                        return '<div style="width:130px; margin:0 auto;">' . nl2br($data->date) . '</div>';
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a('<button type="button" class="btn btn-primary">Переглянути</button>', ['view', 'id' => $model->id], [
                                'title' => 'Переглянути',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                            
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
