<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ParentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мій клас - ' . Yii::$app->user->identity->class->name . ' (Батьки)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parents-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати нового члена родини', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'class' => 'yii\grid\SerialColumn',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'child_name',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        return Html::a($data->child_name, ['/teachers/my-class/students/view', 'id' => $data->child->user_id], 
                            ['target' => '_blank']);
                    },
                ],
                // 'name',
                [
                    'attribute' => 'name',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                'email:email',
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
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'template' => '{view} {edit} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model) {
                            return Html::a('<i class="fa fa-trash-o control-label fa-school_diary" aria-hidden="true"></i>', ['delete', 'id' => $model->user_id], [
                                'class' => 'has-error',
                                'title' => 'Видалити',
                                'data' => [
                                    'confirm' => 'Ви дійсно хочете видалити користувача "' . $model->name . '"?',
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
