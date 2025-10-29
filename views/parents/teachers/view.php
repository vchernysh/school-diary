<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Teachers */

$this->title = $model->name . ' - ' . $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Учителі', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'image',
                    'label' => '',
                    'format' => 'html',
                    'value' => function($data) {
                        return '<a href="' . $data->user->image . '" title="' . $data->user->name . '" class="fancybox" rel="gallery">
                                    <img src="' . $data->user->image . '" alt="' . $data->user->name . '" class="user_image">
                                </a>';
                    }
                ],
                'user_id',
                'name',
                'fio',
                'subject',
                [
                    'attribute' => 'phone',
                    'label' => 'Телефон',
                    'format' => 'html',
                    'value' => function($data) {

                        if (!$data->user->phone) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return '<a href="tel:' . $data->user->phone . '" target="_blank">' . $data->user->phone . '</a>';
                        }
                    }
                ],
                [
                    'attribute' => 'birthday',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {

                        if (!$data->user->birthday) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return myDate('ua', $data->user->birthday) . ' - (' . age($data->user->birthday) . ')';
                        }
                    }
                ],
                [
                    'attribute' => 'custom_type',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->user->type . '">' . $data->user->custom_type . '</span>';
                    }
                ],
                [
                    'attribute' => 'telegram_chat_id',
                    'label' => 'Telegram ID',
                    'format' => 'html',
                    'value' => function($data) {

                        if (!$data->user->telegram->telegram_chat_id) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return '<span class="telegram_color">' . $data->user->telegram->telegram_chat_id . '</span>';
                        }
                    }
                ],
            ],
        ]) ?>
    </div>

</div>
