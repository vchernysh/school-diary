<?php

use yii\helpers\{Html, ArrayHelper};
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Предмети класу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <br>
    <div class="row">
        <div class="col-sm-5">
            <label class="control-label" for="available_select">Доступні предмети школи</label>
            <select multiple size="20" name="available" class="form-control" id="available_select" data-target="available">
                <optgroup label="Предмети школи">
                    <?php foreach($subjects as $key => $subject) : ?>
                        <option value="<?= $subject['id'] ?>"><?= $subject['subject_name'] ?></option>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </div>
        <div class="col-sm-1 assigned_buttons">
            <br><br>
            <?= Html::button('&gt;&gt;', [
                'class' => 'btn btn-success btn-assign',
                'title' => 'Додати',
                'data' => [
                    'id' => $model->id,
                    'target' => 'available',
                    'needed' => 'assigned',
                ],
            ]);?><br><br>
            <?= Html::button('&lt;&lt;', [
                'class' => 'btn btn-danger btn-revoke',
                'title' => 'Видалити',
                'data' => [
                    'id' => $model->id,
                    'target' => 'assigned',
                    'needed' => 'available',
                ],
            ]);?><br><br>
        </div>
        <div class="col-sm-5">
            <label class="control-label" for="assigned_select">Предмети класу <?= $model->name ?></label>
            <select multiple size="20" name="assigned" class="form-control" id="assigned_select" data-target="assigned">
                <optgroup label="Предмети класу <?= $model->name ?>">
                    <?php foreach($class_subjects as $subject) : ?>
                        <option value="<?= $subject->id ?>"><?= $subject->subject_name ?></option>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </div>
    </div>
</div>
<?php $this->registerJsFile('@web/js/dir_teach.js', ['depends' => [JqueryAsset::class]]); ?>