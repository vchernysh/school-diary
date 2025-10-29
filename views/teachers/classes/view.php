<?php

use yii\helpers\{Url, Html};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

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
                        if (!$data->teacher_name) {
                            return '<span class="not-set">(не задано)</span>';
                        } else {
                            return Html::a($data->teacher_name . ' - ' . $data->subject->subject, ['/teachers/teachers/view', 'id' => $data->teacher->id], ['target' => '_blank']);
                        }
                    },
                ],
                'count_of_students',
                [
                    'attribute' => 'schedule',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'headerOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return Html::a('Розклад', ['schedule', 'id' => $data->id], ['class' => 'btn btn-success']);
                    }
                ],
                [
                    'attribute' => 'subjects',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['text-align' => 'left', 'padding-left' => 0]],
                    'value' => function($data) {

                        $html = "<ul>\n";
                        foreach($data->classSubjects as $subject) :
                            $html .= "<li>" . $subject->subject_name . "</li>\n";
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
                        $html .= "<li><a target=\"_blank\" href=\"" . Url::to(['/teachers/teachers/view', 'id' => $data->teacher->id]) . "\">" . $data->teacher_name . " - " . $data->subject->subject . "</a></li>\n";
                        $html .= "<ul>Усі предмети</ul>\n";

                        foreach($data->teachers_subjects as $teacher) :
                            $html .= "<li><a target=\"_blank\" href=\"" . Url::to(['/teachers/teachers/view', 'id' => $teacher['id']]) . "\">" . $teacher['name'] . "</a></li>\n";
                            
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
