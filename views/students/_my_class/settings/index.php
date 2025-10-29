<?php

use yii\helpers\{Html, Url};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Мій клас - ' . Yii::$app->user->identity->student_class->name . ' (Налаштування)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classes-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <p class="paragraph_with_links">
        <?= Html::a('Розклад уроків класу', ['/students/my-class/schedule'], ['class' => 'btn btn-info']) ?>
    </p>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                
                // 'id',
                'name',
                [
                    'attribute' => 'teacher_name',
                    'format' => 'html',
                    'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                    'value' => function($data) {
                        return Html::a($data->teacher_name . ' - ' . $data->subject->subject, ['/students/teachers/view/', 'id' => $data->class_teacher_id]);
                    },
                ],
                'count_of_students',
                [
                    'attribute' => 'list_of_students',
                    'format' => 'html',
                    'captionOptions' => ['style' => ['vertical-align' => 'middle']],
                    'contentOptions' => ['style' => ['text-align' => 'left']],
                    'value' => function($data) {
                        return Html::a('Список учнів', ['/students/my-class/students/index'], ['class' => 'btn btn-primary']);
                    },
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
                    'format' => 'html',
                    'contentOptions' => ['style' => ['text-align' => 'left', 'padding-left' => 0]],
                    'value' => function($data) {

                        $html = "<ul>\n";
                        $html .= "<li><a href=\"" . Url::to(['/students/teachers/view/' . $data->teacher->id]) . "\">" . $data->teacher_name . " - " . $data->subject->subject . "</a></li>\n";
                        $html .= "<ul>Усі предмети</ul>\n";

                        foreach($data->teachers_subjects as $teacher) :
                            $html .= "<li><a href=\"" . Url::to(['/students/teachers/view/' . $teacher['id']]) . "\">" . $teacher['name'] . "</a></li>\n";
                            
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
