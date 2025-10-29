<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\InfoAboutSchool */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Info About Schools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-about-school-index">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Info About School', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'school_id',
                'info:ntext',
                'info_html:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
