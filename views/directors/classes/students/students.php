<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Учні - ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->controller->school__payment_type == 'all' && Yii::$app->user->identity->school->is_test == 'no') { ?>
        <?php if (Yii::$app->controller->school__max_students > Yii::$app->controller->_count_students) { ?>
            <p><?= Html::a('Додати учня', ['add-student', 'class_id' => $model->id], ['class' => 'btn btn-success']) ?></p>
        <?php } ?>
    <?php } else { ?>
        <p><?= Html::a('Додати учня', ['add-student', 'class_id' => $model->id], ['class' => 'btn btn-success']) ?></p>
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
                // [
                // 	'attribute' => 'parents_of_student',
                // 	'format' => 'html',
                // 	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                //     'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                // 	'value' => function($data) {
                // 		return Html::a('Батьки учня', ['parents-of-student', 'student_id' => $data->user_id, 'class_id' => $data->class_id], ['class' => 'btn btn-success']);
                // 	},
                // ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                    'template' => '{view} {edit} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model) {
                            return Html::a('<i class="fa fa-trash-o control-label fa-school_diary" aria-hidden="true"></i>', ['delete-student', 'class_id' => $model->class_id, 'student_id' => $model->user_id], [
                                'class' => 'has-error',
                                'title' => 'Видалити',
                                'data' => [
                                    'confirm' => 'Ви дійсно хочете видалити учня "' . $model->name . '"?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                        'view' => function($url, $model) {
                            return Html::a('<i class="fa fa-eye control-label fa-school_diary" aria-hidden="true"></i>', 
                                ['student', 'class_id' => $model->class_id, 'student_id' => $model->user_id], [
                                'title' => 'Переглянути',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]);
                        },
                        'edit' => function($url, $model) {
                            return Html::a('<i class="fa fa-pencil control-label fa-school_diary" aria-hidden="true"></i>', ['edit-student', 'class_id' => $model->class_id, 'student_id' => $model->user_id], [
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
