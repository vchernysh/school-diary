<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ParentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мій клас - ' . Yii::$app->user->identity->student_class->name . ' (Мої Батьки)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parents-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
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
                // 'user_id',
                // [
                //     'attribute' => 'child_name',
                //     'format' => 'html',
                //     'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                //     'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                //     'value' => function($data) {
                //         return Html::a($data->child_name, ['/students/my-class/students/view', 'id' => $data->child->user_id]);
                //     },
                // ],
                // 'name',
                [
                    'attribute' => 'name',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                // 'email:email',
                // 'type',
                [
                    'attribute' => 'custom_type',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->type . '">' . $data->custom_type . '</span>';
                    }
                ],
                [
                    'attribute' => 'telegram_id',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        if (!$data->user->telegram->telegram_chat_id) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return '<span class="telegram_color">' . $data->user->telegram->telegram_chat_id . '</span>';
                        }
                    }
                ],
                [
                    'attribute' => 'phone',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        if ($data->user->phone) {
                            return '<a href="tel:' . $data->user->phone . '">' . $data->user->phone . '</a>';
                        } else {
                            return '<i class="not-set">(не задано)</i>';
                        }
                    },
                ],
                [
                    'attribute' => 'birthday',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        if (!$data->user->birthday) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return myDate('ua', $data->user->birthday) . ' - (' . age($data->user->birthday) . ')';
                        }
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a('Переглянути', ['view', 'id' => $model->user_id], [
                                'class' => 'btn btn-primary',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
