<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $class->name, 'url' => ['view', 'id' => $class->id]];
$this->params['breadcrumbs'][] = ['label' => 'Учні - ' . $class->name, 'url' => ['students', 'class_id' => $class->id]];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="students-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p class="class-for-paragraph-links">
        
        <?php if (Yii::$app->controller->school__payment_type == 'all' && Yii::$app->user->identity->school->is_test == 'no') { ?>
            <?php if (Yii::$app->controller->school__max_students > Yii::$app->controller->_count_students) { ?>
                <?= Html::a('Додати нового учня', ['add-student', 'class_id' => $model->class_id], ['class' => 'btn btn-success']) ?>
            <?php } ?>
        <?php } else { ?>
            <?= Html::a('Додати нового учня', ['add-student', 'class_id' => $model->class_id], ['class' => 'btn btn-success']) ?>
        <?php } ?>
        <?= Html::a('Змінити', ['edit-student', 'class_id' => $model->class_id, 'student_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete-student', 'class_id' => $model->class_id, 'student_id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цього учня?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                
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
                'user_id',
                'username',
                'email:email',
                'name',
                'fio',
                [
                    'attribute' => 'class_id',
                    'value' => function($data) {
                        return $data->class->name;
                    }
                ],
                [
                    'attribute' => 'phone',
                    'label' => 'Телефон',
                    'format' => 'html',
                    'value' => function($data) {

                        if (!$data->user->phone) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return '<a href="tel:' . $data->user->phone . '" target="_blank">' . $data->user->phone . '</a>';
                        }
                    }
                ],
                [
                    'attribute' => 'birthday',
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
                    'attribute' => 'custom_type',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return '<span class="my-btn btn-' . $data->user->type . '">' . $data->user->custom_type . '</span>';
                    }
                ],
                [
                    'attribute' => 'telegram_chat_id',
                    'label' => 'Telegram Chat ID',
                    'format' => 'html',
                    'value' => function($data) {

                        if (!$data->user->telegram->telegram_chat_id) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return '<span class="telegram_color">' . $data->user->telegram->telegram_chat_id . '</span>';
                        }
                    }
                ],
                // [
                //     'attribute' => 'parents_of_student',
                //     'format' => 'html',
                //     'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                //     'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                //     'value' => function($data) {
                //         return Html::a('Батьки учня', ['parents-of-student', 'student_id' => $data->user_id, 'class_id' => $data->class_id], ['class' => 'btn btn-success']);
                //     },
                // ],
            ],
        ]) ?>
    </div>

</div>
