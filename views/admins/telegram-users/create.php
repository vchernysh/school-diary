<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Telegram */

$this->title = 'Додати Telegram ID для користувача';
$this->params['breadcrumbs'][] = ['label' => 'Користувачі Telegram', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telegram-create">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'request' => $request
    ]) ?>

</div>
