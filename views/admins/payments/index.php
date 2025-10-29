<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оплата за журнал';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <br>
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
                    'attribute' => 'order_id',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'payment_id',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'payerName',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'format' => 'html',
                    'value' => function($data) {
                        return '<span class="span-display-block" title="' . $data->payer_id . '">' . $data->payerName . '</span>';
                    }
                ],
                [
                    'attribute' => 'studentName',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'format' => 'html',
                    'value' => function($data) {
                        return '<span class="span-display-block" title="' . $data->student_id . '">' . $data->studentName . '</span>';
                    }
                ],
                [
                    'attribute' => 'amount',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'currency',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                ],
                [
                    'attribute' => 'date_to',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'value' => function($data) {
                        return '<span class="span-inline-block">' . $data->date_to . '</span>';
                    }
                ],
                [
                    'attribute' => 'status',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'format' => 'html',
                    'value' => function($data) {
                        if ($data->unix_date_to > time()) {
                            return '<span class="my-btn btn-active-payment">Активний</span>';
                        } else {
                            return '<span class="my-btn btn-not-active-payment">Не активний</span>';
                        }
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function($url, $model) {
                            return Html::a('Детальніше', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
