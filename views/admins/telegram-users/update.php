<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Telegram */

$this->title = 'Змінити Telegram ID: ' . $model->name . ' - ' . $model->telegram_chat_id;
$this->params['breadcrumbs'][] = ['label' => 'Користувачі Telegram', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name . ' - ' . $model->telegram_chat_id, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Змінити';
?>
<div class="telegram-update">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
    ]) ?>

</div>
