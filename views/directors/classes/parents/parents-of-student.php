<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = 'Батьки учня';
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $class->name, 'url' => ['view', 'id' => $class->id]];
$this->params['breadcrumbs'][] = ['label' => 'Учні - ' . $class->name, 'url' => ['students', 'class_id' => $class->id]];
$this->params['breadcrumbs'][] = ['label' =>  $model->name, 'url' => ['student', 'class_id' => $class->id, 'student_id' => $model->user_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="parents-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати нового члена родини', ['add-parents', 'class_id' => $class->id, 'student_id' => $model->user_id], ['class' => 'btn btn-success']) ?>
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
                'user_id',
                [
                    'attribute' => 'child_name',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        return Html::a($data->child_name, ['/directors/students/view', 'id' => $data->child->user_id], 
                            ['target' => '_blank']);
                    },
                ],
                'name',
                'email:email',
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
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', ['parents-view', 'id' => $model->user_id]);
                        },
                        'delete' => function($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash control-label"></span>', ['delete', 'id' => $model->user_id], [
                                'class' => 'has-error',
                                'data' => [
                                    'confirm' => 'Ви дійсно хочете видалити користувача "' . $model->name . '"?',
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