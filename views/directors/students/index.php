<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Учні';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->controller->school__payment_type == 'all' && Yii::$app->user->identity->school->is_test == 'no') { ?>
        <?php if (Yii::$app->controller->school__max_students > Yii::$app->controller->_count_students) { ?>
            <p><?= Html::a('Додати учня', ['create'], ['class' => 'btn btn-success']) ?></p>
        <?php } ?>
    <?php } else { ?>
        <p><?= Html::a('Додати учня', ['create'], ['class' => 'btn btn-success']) ?></p>
    <?php } ?>

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
                    'attribute' => 'class_name',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        return Html::a($data->class->name, ['/directors/classes/view', 'id' => $data->class_id], 
                            ['target' => '_blank']);
                    },
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'username',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'email',
                    'format' => 'email',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'template' => '{view} {edit} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model) {
                            return Html::a('<i class="fa fa-trash-o control-label fa-school_diary" aria-hidden="true"></i>', ['delete', 'id' => $model->user_id], [
                                'class' => 'has-error',
                                'title' => 'Видалити',
                                'data' => [
                                    'confirm' => 'Ви дійсно хочете видалити учня "' . $model->name . '"?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                        'view' => function($url, $model) {
                            return Html::a('<i class="fa fa-eye control-label fa-school_diary" aria-hidden="true"></i>', ['view', 'id' => $model->user_id], [
                                'title' => 'Переглянути',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        },
                        'edit' => function($url, $model) {
                            return Html::a('<i class="fa fa-pencil control-label fa-school_diary" aria-hidden="true"></i>', ['update', 'id' => $model->user_id], [
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
