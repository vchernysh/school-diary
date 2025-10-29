<?php

use yii\helpers\{Html, ArrayHelper, Url};
use yii\bootstrap\ActiveForm;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Мій клас - ' . Yii::$app->user->identity->class->name . ' (доступ вчителів до предметів)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-subjects-access-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?php if (!$class_subjects) { ?>
        <code>Необхідно додати хоча б один предмет до класу. Зробити це можна за наступним посиланням: <?= Html::a(Url::to(['/teachers/my-class/subjects'], true), Url::to(['/teachers/my-class/subjects'], true)) ?></code>
        <br><br>
    <?php } ?>

    <?php $form = ActiveForm::begin([
        'id' => 'teachers-subjects-access-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-12\">{label}</div>\n<div class=\"col-lg-4 col-md-5 col-sm-5\">{input}</div>\n<div class=\"col-lg-4 col-md-5 col-sm-5\">{error}</div>",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>
    
    <?= Html::hiddenInput('ClassTeachersSubjectsAccess[class_id]', $model->id, ['class' => 'hidden_class_id']); ?>

    <?= $form->field($another_model, 'teacher_id')->label('Виберіть вчителя: ')->dropdownList(ArrayHelper::map($class_teachers_access, 'id', 'name'), 
        ['prompt' => [
            'text' => 'Виберіть вчителя',
            'options'=> ['disabled' => true, 'selected' => true]
        ]]); ?>

    <label class="control-label">Предмети класу: <span class="loader-ajax"></span></label>
    <div class="checkbox-subjects-wrap">
        <?php if ($class_subjects) { ?>
            <?php foreach($class_subjects as $subject) : ?>
                <?//= Html::checkbox('ClassTeachersSubjectsAccess[subjects][]', false, ['value' => $subject->id, 'label' => $subject->subject_name]); ?>
                <div class="tsa_switch">
                    <div class="switch">
                        <input type="checkbox" name="ClassTeachersSubjectsAccess[subjects][]" value="<?= $subject->id ?>">
                        <span class="slider round"></span>
                    </div> <?= $subject->subject_name ?>
                </div>
                <br>
            <?php endforeach; ?>
        <?php } else { ?>
            <p><i>Немає жодного зареєстрованого предмета для класу.</i></p>
        <?php } ?>
    </div>
    <br>
    <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJsFile('@web/js/dir_teach.js', ['depends' => [JqueryAsset::class]]); ?>