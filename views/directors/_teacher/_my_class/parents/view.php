<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Parents */

$this->title = $model->name . ' - ' . $model->custom_type;
$this->params['breadcrumbs'][] = ['label' => 'Мій клас - ' . Yii::$app->user->identity->class->name . ' (Батьки)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="parents-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p class="class-for-paragraph-links">
        <?= Html::a('Додати нового члена родини', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Змінити', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити цього користувача з системи?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <br>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [

                [
                    'attribute' => 'divider_parent',
                    'label' => '<p class="underline">Інформація про ' . $parent['info_about_parent'] . '</p>',
                    'format' => 'html',
                    'value' => '<p class="underline">Інформація про ' . $parent['info_about_parent'] . '</p>',
                ],
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
                [
                    'attribute' => 'user_id',
                    'label' => 'ID ' . $parent['label_parent'],
                    'format' => 'html',
                    'value' => function($data) {
                        return $data->user->id;
                    },
                ],
                [
                    'attribute' => 'name',
                    'label' => 'Ім\'я ' . $parent['label_parent'],
                    'value' => function($data) {
                        return $data->user->name;
                    },
                ],
                [
                    'attribute' => 'fio',
                    'label' => 'П.І.Б. ' . $parent['label_parent'],
                    'value' => function($data) {
                        return $data->user->fio;
                    },
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email ' . $parent['label_parent'],
                    'format' => 'html',
                    'value' => function($data) {
                        return '<a href="mailto:' . $data->user->email . '">' . $data->user->email . '</a>';
                    },
                ],
                [
                    'attribute' => 'username',
                    'label' => 'Логін ' . $parent['label_parent'],
                    'value' => function($data) {
                        return $data->user->username;
                    },
                ],
                [
                    'attribute' => 'phone',
                    'format' => 'html',
                    'label' => 'Телефон ' . $parent['label_parent'],
                    'value' => function($data) {
                        if ($data->user->phone) {
                            return '<a href="tel:' . $data->user->phone . '">' . $data->user->phone . '</a>';
                        } else {
                            return '<i class="not-set">(не задано)</i>';
                        }
                    },
                ],
                [
                    'attribute' => 'birthday',
                    'label' => 'День народження ' . $parent['label_parent'],
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
                    'attribute' => 'telegram_id',
                    'label' => 'Telegram ID ' . $parent['label_parent'],
                    'format' => 'html',
                    'value' => function($data) {
                        if (!$data->user->telegram->telegram_chat_id) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return '<span class="telegram_color">' . $data->user->telegram->telegram_chat_id . '</span>';
                        }
                    }
                ],
                [
                    'attribute' => 'custom_type',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->type . '">' . $data->custom_type . '</span>';
                    }
                ],
            ],
        ]) ?>
    </div>

    <br><br>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [

                [
                    'attribute' => 'divider_child',
                    'label' => '<p class="underline">Інформація про дитину</p>',
                    'format' => 'html',
                    'value' => '<p class="underline">Інформація про дитину</p>',
                ],
                [
                    'attribute' => 'child_image',
                    'label' => '',
                    'format' => 'html',
                    'value' => function($data) {
                        return '<a href="' . $data->child_user->image . '" title="' . $data->child_user->name . '" class="fancybox" rel="gallery">
                                    <img src="' . $data->child_user->image . '" alt="' . $data->child_user->name . '" class="user_image">
                                </a>';
                    }
                ],
                [
                    'attribute' => 'child_id',
                    'value' => function($data) {
                        return $data->child_user->id;
                    },
                ],
                'child_name',
                [
                    'attribute' => 'child_fio',
                    'value' => function($data) {
                        return $data->child_user->fio;
                    },
                ],
                'child_email:email',
                [
                    'attribute' => 'child_username',
                    'format' => 'html',
                    'value' => function($data) {
                        return $data->child_user->username;
                    },
                ],
                [
                    'attribute' => 'child_phone',
                    'format' => 'html',
                    'value' => function($data) {
                        if ($data->child_user->phone) {
                            return '<a href="tel:' . $data->child_user->phone . '">' . $data->child_user->phone . '</a>';
                        } else {
                            return '<i class="not-set">(не задано)</i>';
                        }
                    },
                ],
                [
                    'attribute' => 'child_birthday',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {

                        if (!$data->child_user->birthday) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return myDate('ua', $data->child_user->birthday) . ' - (' . age($data->child_user->birthday) . ')';
                        }
                    }
                ],
                [
                    'attribute' => 'child_telegram_id',
                    'format' => 'html',
                    'value' => function($data) {
                        if (!$data->child_user->telegram->telegram_chat_id) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return '<span class="telegram_color">' . $data->child_user->telegram->telegram_chat_id . '</span>';
                        }
                    }
                ],
                [
                    'attribute' => 'child_class',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return $data->class->name;
                    }
                ],
                [
                    'attribute' => 'child_teacher',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return Html::a($data->class_teacher->name, ['/directors/teachers/teachers/view', 'id' => $data->class_teacher->id], 
                            ['target' => '_blank']);
                    }
                ],
                [
                    'attribute' => 'child_director',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return Html::a($data->director_name->name, ['/info-about-director']);
                    }
                ],
                [
                    'attribute' => 'child_type',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->child_user->type . '">' . $data->child_user->custom_type . '</span>';
                    }
                ],
            ],
        ]) ?>
    </div>

</div>
