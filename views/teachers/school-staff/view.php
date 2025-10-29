<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolStaff */

$this->title = $model->name . ' - ' . $model->position;
$this->params['breadcrumbs'][] = ['label' => 'Персонал школи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-staff-view">

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
                        return '<a href="' . $data->image . '" title="' . $data->name . '" class="fancybox" rel="gallery">
                                    <img src="' . $data->image . '" alt="' . $data->name . '" class="user_image">
                                </a>';
                    }
                ],
                'id',
                'name',
                'position',
                // 'birthday',
                [
                    'attribute' => 'birthday',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {

                        if (!$data->birthday) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return myDate('ua', $data->birthday) . ' - (' . age($data->birthday) . ')';
                        }
                    }
                ],
            ],
        ]) ?>
    </div>

</div>
