<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentsForAllSchool */

$this->title = 'Оплата №' . $model->id . ' - ' . $model->school->name;
$this->params['breadcrumbs'][] = ['label' => 'Оплата за всю школу', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payments-for-all-school-view">

    <img src="/images/visa-icon.png" title="Visa" alt="Visa" class="visa-img payment-nav-img">
    <img src="/images/mastercard-icon.png" alt="MasterCard" title="MasterCard" class="mastercard-img payment-nav-img">
    <br>
    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цю оплату?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'school_id',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function ($data) {
                    return $data->school->name;
                },
            ],
            [
                'attribute' => 'amount',
                'captionOptions' => ['style' => ['vertical-align' => 'middle;']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function ($data) {
                    return $data->school->currency->symbol . number_format($data->amount, 2, ',', ' ');
                },
            ],
            [
                'attribute' => 'currency',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'date_from',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'date_to',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
            ],
            // 'unix_date_from',
            // 'unix_date_to',
        ],
    ]) ?>

</div>
