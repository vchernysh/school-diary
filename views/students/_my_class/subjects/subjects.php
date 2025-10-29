<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Мій клас - ' . Yii::$app->user->identity->student_class->name . ' (Предмети)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-5">
            <label class="control-label" for="available_select">Доступні предмети школи</label>
            <select multiple size="20" name="available" class="form-control" id="available_select" data-target="available">
                <optgroup label="Предмети школи">
                    <?php foreach($subjects as $key => $subject) : ?>
                        <option disabled style="color: rgb(85, 85, 85);" value="undefined"><?= $subject['subject_name'] ?></option>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </div>
        <div class="col-md-1 col-sm-2 assigned_buttons">
           <br><br>
           <br>
        </div>
        <div class="col-sm-5">
            <label class="control-label" for="assigned_select">Предмети класу <?= $model->name ?></label>
            <select multiple size="20" name="assigned" class="form-control" id="assigned_select" data-target="assigned">
                <optgroup label="Предмети класу <?= $model->name ?>">
                    <?php foreach($class_subjects as $subject) : ?>
                        <option disabled style="color: rgb(85, 85, 85);" value="undefined"><?= $subject->subject_name ?></option>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </div>
    </div>
</div>