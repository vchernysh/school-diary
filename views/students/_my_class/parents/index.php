<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ParentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мій клас - ' . Yii::$app->user->identity->student_class->name . ' (Батьки)';
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
                [
                    'attribute' => 'child_name',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        return Html::a($data->child_name, ['/students/my-class/students/view', 'id' => $data->child->user_id]);
                    },
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
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
