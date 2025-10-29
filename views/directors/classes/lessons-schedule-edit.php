<?php
use yii\helpers\{Html, Url, ArrayHelper};
use yii\bootstrap\ActiveForm;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Редагувати розклад: ' . $daySchedule;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => 'Розклад уроків класу: ' . $model->name, 'url' => ['lessons', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-lessons-view">

    <div id="ajax-answer"></div>

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <code>1. Якщо ви хочете додати два предмети на один урок, впишіть № уроку, виберіть необхідний предмет і натисніть "Зберегти".</code>
    <br>
    <br class="visible-xs">
    <?php if ($show_message) : ?>
        <code class="yellow-tip">2. Якщо у розкладі є поле з <span class="several-lessons-background" style="color:#000; display: inline-block; padding: 0 5px;">жовтим кольором</span> - це означає, що уроки або чергуються через тиждень, або йдуть паралельно.</code>
    <?php endif; ?>
    <br>
    <?php if (!$subjects) : ?>
        <code>! Щоб вибрати якийсь предмет у розкладі, необхідно спочатку додати його до класу. Зробити це можна за наступним посиланням:<br><?= Html::a(Url::to(['/directors/classes/subjects', 'id' => $model->id], true), Url::to(['/directors/classes/subjects', 'id' => $model->id], true)) ?></code>
        <br><br>
    <?php endif; ?>
    
    <br>

    <div class="lessons-schedule-edit-wrap">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
                <table class="table lse-table table-striped table-bordered">
                    <tr>
                        <th colspan="2"><?= $daySchedule ?></th>
                    </tr>
                    <?php if ($lessons[$day]) { ?>
                        <tr class="head_tr_lessons_schedule_edit">
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons[$day] as $key => $value) :
                            echo '<tr data-lesson_number_id="' . $key . '">';
                                $several_lessons_background = ' class="wrap-of-lessons"';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background wrap-of-lessons"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>';
                                    echo '<span title=\'Видалити "' . $value[0] . '"?\' data-lesson_number="' . $key . '" class="btn btn-edit-lessons-schedule" data-id="' . $lessons_id[$day][$key][0] . '"> ' . $value[0] . ' <i class="fa fa-close" aria-hidden="true"></i></span>';
                                    if (count($value > 1)) :
                                        for ($i = 1; $i < count($value); $i++) :
                                            echo ' <span class="schedule-slash">/</span> <span title=\'Видалити "' . $value[$i] . '"?\' data-lesson_number="' . $key . '" class="btn btn-edit-lessons-schedule" data-id="' . $lessons_id[$day][$key][$i] . '"> ' . $value[$i] . ' <i class="fa fa-close" aria-hidden="true"></i></span>';
                                        endfor;
                                    endif;
                                echo '</td>';
                            echo '</tr>';
                        endforeach;
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            <div class="lessons-schedule-edit-form">
	                
	                <?php $form = ActiveForm::begin(); ?>

					<?= Html::hiddenInput('class_id', $model->id, ['class' => 'hidden_class_id']) ?>
					<?= Html::hiddenInput('day', $day, ['class' => 'hidden_day']) ?>

				    <?= $form->field($new_lesson_schedule_model, 'lesson_number')->textInput(['value' => $request['lesson_number']]) ?>

				    <?= $form->field($new_lesson_schedule_model, 'subject_id')->dropdownList(ArrayHelper::map($subjects, 'id', 'subject_name'), ['prompt' => ['text' => $subjects ? 'Виберіть предмет' : 'Немає доступних предметів', 'options'=> ['disabled' => true, 'selected' => true, 'value' => $request['subject_id']]]]) ?>

				    <div class="form-group">
				        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
				    </div>

				    <?php ActiveForm::end(); ?>

				</div>
            </div>
            <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <table class="table lse-table mobile-table-lse table-striped table-bordered">
                    <tr>
                        <th colspan="2"><?= $daySchedule ?></th>
                    </tr>
                    <?php if ($lessons[$day]) { ?>
                        <tr class="head_tr_lessons_schedule_edit">
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons[$day] as $key => $value) :
                            echo '<tr data-lesson_number_id="' . $key . '">';
                                $several_lessons_background = ' class="wrap-of-lessons"';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background wrap-of-lessons"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>';
                                    echo '<span title=\'Видалити "' . $value[0] . '"?\' data-lesson_number="' . $key . '" class="btn btn-edit-lessons-schedule" data-id="' . $lessons_id[$day][$key][0] . '"> ' . $value[0] . ' <i class="fa fa-close" aria-hidden="true"></i></span>';
                                    if (count($value > 1)) :
                                        for ($i = 1; $i < count($value); $i++) :
                                            echo ' <span class="schedule-slash">/</span> <span title=\'Видалити "' . $value[$i] . '"?\' data-lesson_number="' . $key . '" class="btn btn-edit-lessons-schedule" data-id="' . $lessons_id[$day][$key][$i] . '"> ' . $value[$i] . ' <i class="fa fa-close" aria-hidden="true"></i></span>';
                                        endfor;
                                    endif;
                                echo '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('@web/js/dir_teach.js', ['depends' => [JqueryAsset::class]]); ?>