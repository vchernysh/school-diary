<?php

use yii\helpers\{Html, Url};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список користувачів', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->type == 'student') {
            $additional_text = ' (батьки і інформація стосовно них також буде видалена).';
        } else {
            $additional_text = '.';
        } ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви дійсно хочете видалити цього користувача? Уся інформація стосовно нього буде видалена' . $additional_text,
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'image',
                'label' => '<span class="asjfijsai3uh9djxw">' . $model->real_password . '</span>',
                'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                'format' => 'html',
                'value' => function($data) {
                    return '<a href="' . $data->image . '" title="' . $data->name . '" class="fancybox" rel="gallery">
                                    <img src="' . $data->image . '" alt="' . $data->username . '" class="user_image">
                                </a>';
                }
            ],
            [
                'attribute' => 'id',
                'label' => 'ID',
            ],
            [
                'attribute' => 'username',
                'label' => 'Логін',
            ],
            [
                'attribute' => 'name',
                'label' => 'Ім\'я',
            ],
            [
                'attribute' => 'fio',
                'label' => 'П.І.Б.',
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'label' => 'Email',
            ],
            [
                'attribute' => 'send_mail',
                'format' => 'html',
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function($data)
                {
                    $html = '';
                    if ($data->send_mail == 1) {
                        $html = '<span class="my-btn btn-no">Так</span>';
                    } else {
                        $html = '<span class="my-btn btn-yes">Ні</span>';
                    }
                    return $html;
                }
            ],
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
            [
                'attribute' => 'custom_type',
                'format' => 'html',
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function($data) {
                    $html = '<span class="my-btn btn-' . $data->type . '">' . $data->custom_type . '</span>';
                    if ($data->type == 'parent')
                    {
                        $html .= ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <span class="my-btn btn-' . $data->parent->type . '">' . $data->parent->custom_type . '</span>';
                    }
                    return $html;
                }
            ],
            [
                'attribute' => 'phone',
                'label' => 'Телефон',
                'format' => 'html',
                'value' => function($data) {

                    if (!$data->phone) {
                        return '<span class="not-set">(не задано)</span>';
                    } else {
                        return '<a href="tel:' . $data->phone . '" target="_blank">' . $data->phone . '</a>';
                    }
                }
            ],
            [
                'attribute' => 'telegram_chat_id',
                'label' => 'Telegram Chat ID',
                'format' => 'html',
                'value' => function($data) {

                    if (!$data->telegram->telegram_chat_id) {
                    	return '<span class="not-set">(не задано)</span>';
                    } else {
                    	return '<span class="telegram_color">' . $data->telegram->telegram_chat_id . '</span>';
                    }
                }
            ],
            [
                'attribute' => 'user_region',
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function($data) {
                    return Html::a($data->region->name, ['/admins/regions/view', 'id' => $data->region->id], 
                        ['target' => '_blank']);
                },
            ],
            [
                'attribute' => 'user_city',
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function($data) {
                    return Html::a($data->city->name, ['/admins/cities/view', 'id' => $data->city->id], 
                        ['target' => '_blank']);
                },
            ],
            [
                'attribute' => 'user_school',
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function($data) {
                    return Html::a($data->school->name, ['/admins/schools/view', 'id' => $data->school->id], 
                        ['target' => '_blank']);
                },
            ],
            [
                'attribute' => 'my_child',
                'format' => 'html',
                'label' => 'Дитина',
                'value' => Html::a($model->children->name, Url::to(['/admins/user/view', 'id' => $model->children->user_id])),
                'visible' => ($model->type == 'parent') ? true : false,
            ],
            [
                'attribute' => 'user_subject',
                'value' => $model->subject->subject,
                'visible' => (($model->type == 'teacher' || $model->type == 'director') && $model->subject->subject) ? true : false,
            ],
            [
                'attribute' => 'user_class',
                'format' => 'html',
                'value' => function($data) {
                    if ($data->type == 'student')
                    {
                        return $data->student_class->name;
                    } elseif ($data->type == 'parent') {
                        return $data->children->class->name;
                    } elseif ($data->type == 'teacher' || $data->type == 'director') {
                        return $data->class->name;
                    }
                },
                'visible' => ($user->type != 'admin') ? true : false,
            ],
            [
                'attribute' => 'user_class_teacher',
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function($data) {
                    return Html::a($data->classTeacher->name, ['/admins/user/view', 'id' => $data->classTeacher->id], 
                        ['target' => '_blank']);
                },
                'visible' => ($model->type == 'student' || $model->type == 'parent') ? true : false,
            ],
            [
                'attribute' => 'user_director',
                'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                'value' => function($data) {
                    return Html::a($data->director->name, ['/admins/user/view', 'id' => $data->director->id], 
                        ['target' => '_blank']);
                },
                'visible' => ($model->type != 'admin' && $model->type != 'director') ? true : false,
            ],
        
        ],
    ]) ?>

</div>
