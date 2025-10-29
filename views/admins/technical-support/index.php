<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запитання в технічну підтримку';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="alert_answer"></div>

<div class="questions-index">
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
	                'attribute' => 'id',
	                'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'contentOptions' => ['style' => ['vertical-align' => 'middle !important', 'text-align' => 'center !important;']],
	            ],
	            [
	                'attribute' => 'user_name',
	                'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'contentOptions' => ['style' => ['vertical-align' => 'middle !important', 'text-align' => 'center !important;']],
	                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
	                'value' => function($data) {
	                    return Html::a($data->user_name, ['/admins/user/view', 'id' => $data->user_id], 
	                        ['target' => '_blank', 'title' => 'ID: ' . $data->user->id . ' | ' . 'Username: ' . $data->user->username . ' | ' . 'Email: ' . $data->user->email . ' | ' . 'Type: ' . $data->user->type]);
	                },
	            ],
	            [
	                'attribute' => 'custom_type',
	                'format' => 'html',
	                'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'value' => function($data) {
	                    return '<span class="my-btn btn-' . $data->type_message . '">' . $data->custom_type . '</span>';
	                }
	            ],
	            [
	                'attribute' => 'message',
	                'format' => 'ntext',
	                'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
	                'value' => function($data) {
	                    return trunc_letters($data->message, 0, 55, true);
	                },
	            ],
	            [
	                'attribute' => 'custom_status',
	                'format' => 'html',
	                'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'value' => function($data) {
	                    return '<span class="my-btn btn-' . $data->status . '">' . $data->custom_status . '</span>';
	                }
	            ],
	            [
	                'attribute' => 'count_answers',
	                'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'value' => function ($data) {
	                    return $data->count_answers;
	                }
	            ],
	            [
	                'attribute' => 'date',
	                'format' => 'html',
	                'headerOptions' => ['style' => ['text-align' => 'center !important', 'vertical-align' => 'middle !important']],
	                'contentOptions' => ['style' => ['vertical-align' => 'middle !important', 'text-align' => 'center !important;']],
	                'value' => function($data) {
	                    return '<div style="width:130px;">' . nl2br($data->date) . '</div>';
	                },
	            ],

	            [
	                'class' => 'yii\grid\ActionColumn',
	                'header' => Html::a('Видалити Усі', ['delete-all'], [
                        'class' => 'btn btn-danger has-error',
                        'title' => 'Видалити Усі Дані',
                        'data' => [
                            'confirm' => 'Ви дійсно хочете видалити усі діалоги?',
                            'method' => 'post',
                        ],
                    ]),
	                'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
	                'template' => '{access} {view} {delete}',
	                'buttons' => [
	                    'delete' => function($url, $model) {
	                        return Html::a('<i class="fa fa-trash-o control-label fa-school_diary" aria-hidden="true"></i>', ['delete', 'id' => $model->id], [
	                            'class' => 'has-error',
	                            'title' => 'Видалити',
	                            'data' => [
	                                'confirm' => 'Ви дійсно хочете видалити цей лист і всю бесіду з приводу цього листа? (ID: "' . $model->id . '")',
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
	                    'access' => function($url, $model) {
	                        return $model->status == 'closed' ? Html::a('<i class="fa fa-unlock control-label fa-school_diary" aria-hidden="true"></i>', 
	                        	['ajax-status', 'id' => $model->id], [
	                                'title' => 'Відкрити',
	                                'data' => [
	                                    'method' => 'post',
	                                ],
	                            ]) : Html::a('<i class="fa fa-lock control-label fa-school_diary" aria-hidden="true"></i>', 
	                            ['ajax-status', 'id' => $model->id], [
	                                'title' => 'Закрити',
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
