<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CallsScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Розклад дзвінків';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calls-schedule-index">

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
                // ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                // 'school_id',
                // 'lesson_number',
                // 'start',
                // 'end',
                // 'break',

                [
                    'attribute' => 'lesson_number',
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'start',
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'end',
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'break',
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'headerOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'format' => 'html',
                    'value' => function($data) {
                        if (!$data->break) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return $data->break;
                        }
                    },
                ],
                
            ],
        ]); ?>
    </div>
</div>
