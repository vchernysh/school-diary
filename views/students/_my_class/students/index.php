<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мій клас - ' . Yii::$app->user->identity->student_class->name . ' (Учні)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

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
                // 'name',
                // 'username',
                [
                    'attribute' => 'name',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'birthday',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['width' => '200px', 'vertical-align' => 'middle', 'text-align' => 'center']],
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
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
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
