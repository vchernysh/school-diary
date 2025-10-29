<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Currencies */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Валюти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="currencies-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Змінити валюту', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити валюту', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити цю валюту?',
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
                'attribute' => 'name',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'country',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
            ],
            [
                'attribute' => 'symbol',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
            ],
        ],
    ]) ?>

</div>
