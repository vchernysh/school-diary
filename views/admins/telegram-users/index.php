<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TelegramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Користувачі Telegram';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telegram-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати Telegram ID для користувача', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'attribute' => 'user_id',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'name',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'username',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'email',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'telegram_chat_id',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="telegram_color">' . $data->telegram_chat_id . '</span>';
                    }
                ],
                [
                    'attribute' => 'custom_status',
                    'format' => 'html',
                    'headerOptions' => ['style' => ['text-align' => 'center !important;']],
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->status . '">' . $data->custom_status . '</span>';
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => ['text-align' => 'center !important;', 'vertical-align' => 'middle']],
                    'template' => '{view} {edit} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model) {
                            return Html::a('<i class="fa fa-trash-o control-label fa-school_diary" aria-hidden="true"></i>', ['delete', 'id' => $model->user_id], [
                                'class' => 'has-error',
                                'title' => 'Видалити',
                                'data' => [
                                    'confirm' => 'Ви дійсно хочете видалити Telegram ID користувача "' . $model->name . '"?',
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
