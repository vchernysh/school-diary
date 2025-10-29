<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SchoolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Школи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати школу', ['create'], ['class' => 'btn btn-success']) ?>
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
                [
                    'attribute' => 'id',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'director_name',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return Html::a($data->director->name, ['/admins/user/view', 'id' => $data->director->id]);
                    }
                ],
                [
                    'attribute' => 'city_name',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'region_name',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                // 'price',
	            [
	            	'attribute' => 'price',
	            	'format' => 'html',
	            	'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
            		'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	            	'value' => function($data) {
                        if ($data->price)
                        {
                            $html = $data->currency->symbol . number_format($data->price, 0, ',', ' ');
                        } else {
                            $html = '<i class="not-set">(не задано)</i>';
                        }
	            		return $html;
	            	},
	            ],
                [
                    'attribute' => 'price_for_all_school',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        if ($data->price_for_all_school)
                        {
                            $html = $data->currency->symbol . number_format($data->price_for_all_school, 0, ',', ' ');
                        } else {
                            $html = '<i class="not-set">(не задано)</i>';
                        }
                        return $html;
                    },
                ],
                [
                    'attribute' => 'max_students',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        if ($data->max_students)
                        {
                            $html = number_format($data->max_students, 0, ',', ' ');
                        } else {
                            $html = '<i class="not-set">(не задано)</i>';
                        }
                        return $html;
                    },
                ],
                [
                    'attribute' => 'custom_payment_for_school',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        return $data->custom_payment_for_school;
                    },
                ],
	            // 'is_test',
	            // 'custom_test_type',
	            [
	            	'attribute' => 'custom_test_type',
	            	'format' => 'html',
	            	'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
            		'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	            	'value' => function($data) {
	            		return '<span class="my-btn btn-' . $data->is_test . '">' . $data->custom_test_type . '</span>';
	            	},
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
                                    'confirm' => 'Ви дійсно хочете видалити "' . $model->name . '"? Уся інформація стосовно цієї школи, директор, вчителі, учні, батьки, оцінки, предмети, розклад і т.д. будуть видалені назавжди.',
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
