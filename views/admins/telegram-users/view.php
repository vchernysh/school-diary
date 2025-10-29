<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Telegram */

$this->title = $model->name . ' - ' . $model->telegram_chat_id;
$this->params['breadcrumbs'][] = ['label' => 'Користувачі Telegram', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telegram-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Змінити', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити Telegram Chat ID цього користувача?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="table-responsive">
        
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'user_id',
                'name',
                'username',
                'email:email',
                [
                    'attribute' => 'telegram_chat_id',
                    'label' => 'Telegram Chat ID',
                    'format' => 'html',
                    'value' => function($data) {
                        return '<span class="telegram_color">' . $data->telegram_chat_id . '</span>';
                    }
                ],
                [
                    'attribute' => 'custom_status',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->status . '">' . $data->custom_status . '</span>';
                    }
                ],  
            ],
        ]) ?>
        
    </div>

</div>
