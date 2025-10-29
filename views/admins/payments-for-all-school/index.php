<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PaymentsForAllSchoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оплата за всю школу';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-for-all-school-index">

    <img src="/images/visa-icon.png" title="Visa" alt="Visa" class="visa-img payment-nav-img">
    <img src="/images/mastercard-icon.png" alt="MasterCard" title="MasterCard" class="mastercard-img payment-nav-img">
    <br>

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Додати нову оплату', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'school_id',
                'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function ($data) {
                    return $data->school->name;
                },
            ],
            [
                'attribute' => 'amount',
                'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                'value' => function ($data) {
                    return $data->school->currency->symbol . number_format($data->amount, 2, ',', ' ');
                },
            ],
            [
                'attribute' => 'currency',
                'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'date_from',
                'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'date_to',
                'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
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
                                'confirm' => 'Ви дійсно хочете видалити оплату "№' . $model->id . '"?',
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
