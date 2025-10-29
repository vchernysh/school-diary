<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClassesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Класи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-index">
    <code>Щоб додати предмети, змінити розклад, або налаштувати доступ виставлення оцінок вчителями для кожного класу, перейдіть на сторінку повної інформації про клас (<i class="fa fa-eye control-label" aria-hidden="true"></i>).</code>
    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p class="add-links-wrap">
        <?= Html::a('Додати клас', ['create'], ['class' => 'btn btn-success']) ?>
        <?php if (Yii::$app->controller->school__payment_type == 'all' && Yii::$app->user->identity->school->is_test == 'no') { ?>
            <?php if (Yii::$app->controller->school__max_students > Yii::$app->controller->_count_students) { ?>
                <?= Html::a('Додати учня', ['/directors/students/create'], ['class' => 'btn btn-primary']) ?>
            <?php } ?>
        <?php } else { ?>
            <?= Html::a('Додати учня', ['/directors/students/create'], ['class' => 'btn btn-primary']) ?>
        <?php } ?>

        <?//= Html::a('Додати нового члена родини', ['/directors/parents/create'], ['class' => 'btn btn-warning']) ?>
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
                    'attribute' => 'name',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],

                [
                    'attribute' => 'teacher_name',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        if (!$data->teacher_name) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return Html::a($data->teacher_name, ['/directors/teachers/view', 'id' => $data->teacher->id], ['target' => '_blank']);
                        }
                    },
                ],


                [
                    'attribute' => 'count_of_students',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'list_of_students',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        return Html::a('Список учнів', ['students', 'class_id' => $data->id], ['class' => 'btn btn-primary']);
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
                                    'confirm' => 'Ви дійсно хочете видалити клас "' . $model->name . '"? Усі учні та їхні батьки будуть також видалені назавжди!',
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
