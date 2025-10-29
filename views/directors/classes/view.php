<?php

use yii\helpers\{Html, Url};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p class="paragraph_with_links">
        <?= Html::a('Додати предмети до класу', ['subjects', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Доступ виставлення оцінок вчителями', ['teachers-access', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Доступ вчителів до предметів', ['teachers-subjects-access', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <p class="paragraph_with_links">
        <?= Html::a('Розклад уроків класу', ['lessons', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

    <p>
        <?= Html::a('Змінити ' . $model->name, ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити ' . $model->name, ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цей клас? Усі учні та їхні батьки будуть також видалені назавжди!',
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
                    'attribute' => 'teacher_name',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        if ($data->teacher_name) {
                            return Html::a($data->teacher_name . ' - ' . $data->subject->subject, ['/directors/teachers/view', 'id' => $data->teacher->id], ['target' => '_blank']);
                        } else {
                            return '<span class="not-set">(не задано)</span>';
                        }
                    },
                ],
                'count_of_students',
                [
                    'attribute' => 'list_of_students',
                    'format' => 'html',
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                    'contentOptions' => ['style' => ['text-align' => 'left']],
                    'value' => function($data) {
                        return Html::a('Список учнів', ['students', 'class_id' => $data->id], ['class' => 'btn btn-primary']);
                    },
                ],
                [
                    'attribute' => 'subjects',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['text-align' => 'left', 'padding-left' => 0]],
                    'value' => function($data) {

                        $html = "<ul>\n";
                        foreach($data->classSubjects as $subject) :
                            $html .= "<li><a target=\"_blank\" href=\"" . Url::to(['/directors/subjects/view', 'id' => $subject->id]) . "\">" . $subject->subject_name . "</a></li>\n";
                        endforeach;
                        $html .= '</ul>';
                        return $html;
                    },
                    'visible' => ($model->classSubjects) ? true : false,
                ],
                [
                    'attribute' => 'teachers',
                    'format' => ['html', ['Attr.AllowedFrameTargets' => ['_blank']]],
                    'contentOptions' => ['style' => ['text-align' => 'left', 'padding-left' => 0]],
                    'value' => function($data) {

                        $html = "<ul>\n";
                        $html .= "<li><a target=\"_blank\" href=\"" . Url::to(['/directors/teachers/view', 'id' => $data->teacher->id]) . "\">" . $data->teacher_name . " - " . $data->subject->subject . "</a></li>\n";
                        $html .= "<ul>Усі предмети</ul>\n";

                        foreach($data->teachers_subjects as $teacher) :
                            $html .= "<li><a target=\"_blank\" href=\"" . Url::to(['/directors/teachers/view', 'id' => $teacher['id']]) . "\">" . $teacher['name'] . "</a></li>\n";
                            
                            if ($data->teachers_subjects[$teacher['id']]['subjects']) {
                                $html .= "<ul>\n";
                                    foreach($data->teachers_subjects[$teacher['id']]['subjects'] as $subject) :
                                        $html .= "<li>" . $subject . "</li>\n";
                                    endforeach;
                                $html .= "</ul>\n";
                            } else {
                                $html .= "<ul><li>Не задано жодного предмета</li></ul>\n";
                            }

                        endforeach;
                        $html .= '</ul>';
                        return $html;
                    },
                    'visible' => ($model->teachers_subjects) ? true : false,
                ],
            ],
        ]) ?>
    </div>

</div>
