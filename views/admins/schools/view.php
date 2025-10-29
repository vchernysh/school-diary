<?php

use yii\helpers\{Html, Url};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Schools */

$this->title = $model->name . ' - місто ' . $model->city_name;
$this->params['breadcrumbs'][] = ['label' => 'Школи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-view">
    <img src="/images/country/<?= $model->currency->name ?>.png" alt="<?= $model->currency->country ?>" class="country-img">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити цю школу? Уся інформація стосовно неї, директор, вчителі, учні, батьки, оцінки, предмети, розклад і т.д. будуть видалені назавжди.',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                [
                    'attribute' => 'director_name',
                    'format' => 'html',
                    'value' => function($data) {
                        return Html::a($data->director->name, ['/admins/user/view', 'id' => $data->director->id]);
                    }
                ],
                'city_name',
                'region_name',
                [
                    'attribute' => 'school_currency_ID',
                    'format' => 'html',
                    'value' => function($data) {
                        return $data->currency->name;
                    }
                ],
                [
                    'attribute' => 'custom_payment_for_school',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return $data->custom_payment_for_school;
                    },
                ],
                // 'price',
                [
                	'attribute' => 'price',
                	'format' => 'html',
                	'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        if ($data->price)
                        {
                            $html = $data->currency->symbol . number_format($data->price, 0, ',', ' ');
                        } else {
                            $html = '<i class="not-set">(не задано)</i>';
                        }
                        return $html;
                    },
                ],
                [
                    'attribute' => 'price_for_all_school',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        if ($data->price_for_all_school)
                        {
                            $html = $data->currency->symbol . number_format($data->price_for_all_school, 0, ',', ' ');
                        } else {
                            $html = '<i class="not-set">(не задано)</i>';
                        }
                        return $html;
                    },
                ],
                [
                    'attribute' => 'max_students',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        if ($data->max_students)
                        {
                            $html = number_format($data->max_students, 0, ',', ' ');
                        } else {
                            $html = '<i class="not-set">(не задано)</i>';
                        }
                        return $html;
                    },
                ],
                [
                    'attribute' => 'teacher_subject',
                    'value' => function($data) {
                        return $data->teacherDirector->subject;
                    }
                ],
                // 'is_test',
                [
                    'attribute' => 'custom_test_type',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->is_test . '">' . $data->custom_test_type . '</span>';
                    },
                ],
            ],
        ]) ?>
    </div>

</div>
