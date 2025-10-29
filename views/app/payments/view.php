<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Parents */

$this->title = 'Оплата № ' .  $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Оплата за журнал', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payments-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [

            	[
                    'attribute' => 'status',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
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
                    'attribute' => 'order_id',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'payment_id',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'payerName',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                    'format' => 'html',
                    'value' => function($data) {
                        if ($data->payer->type == 'parent')
                        {
                            return $data->payerName . ' <span style="margin-left:10px;" class="my-btn btn-' . Yii::$app->user->identity->parent->type . '">' . Yii::$app->user->identity->parent->custom_type . '</span>';
                        } elseif ($data->payer->type == 'student') {
                            return $data->payerName . ' <span style="margin-left:10px;" class="my-btn btn-' . $data->payer->type . '">' . $data->payer->custom_type . '</span>';
                        }
                    }
                ],
                [
                    'attribute' => 'studentName',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                    'format' => 'html',
                    'value' => $model->studentName . ' <span style="margin-left:10px;" class="my-btn btn-' . $model->student->type . '">' . $model->student->custom_type . '</span>',
                ],
                [
                    'attribute' => 'amount',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'currency',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                ],
                [
                    'attribute' => 'date_from',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="span-inline-block">' . $data->date_from . '</span>';
                    }
                ],
                [
                    'attribute' => 'date_to',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="span-inline-block">' . $data->date_to . '</span>';
                    }
                ],
                [
                    'attribute' => 'description',
                    'label' => 'Опис',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return $data->liqpay->description;
                    }
                ],

            ],
        ]) ?>
    </div>
</div>
