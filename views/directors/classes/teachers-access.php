<?php

use yii\helpers\{Html, ArrayHelper, Url};
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Доступ вчителів для виставлення оцінок: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-access-view">

	<code>Після того, як ви налаштуєте доступ виставлення оцінок певного класу для вчителів, необхідно задати, по яким саме предметам вчитель має можливість виставляти оцінки. Щоб зробити це, перейдіть за наступним посиланням: <?= Html::a(Url::to(['teachers-subjects-access', 'id' => $model->id], true), Url::to(['teachers-subjects-access', 'id' => $model->id], true)) ?></code>

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <br>
    <div class="row">
        <div class="col-sm-5">
            <label class="control-label" for="available_select">Вчителі школи</label>
            <select multiple size="20" name="available" class="form-control" id="available_select" data-target="available">
                <optgroup label="Вчителі школи">
                    <?php foreach($teachers as $key => $teacher) : ?>
                        <option value="<?= $teacher['id'] ?>">• <?= $teacher['name'] . ' - ' . $teacher['subject'] ?></option>
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
            <label class="control-label" for="assigned_select">Вчителі, які можуть виставляти оцінки для класу <?= $model->name ?></label>
            <select multiple size="20" name="assigned" class="form-control" id="assigned_select" data-target="assigned">
                <optgroup label="Доступ вчителів до оцінок класу <?= $model->name ?>">
                    <?php foreach($class_teachers_access as $teacher) : ?>
                        <option value="<?= $teacher->id ?>">• <?= $teacher->name . ' - ' . $teacher->subject->subject ?></option>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </div>
    </div>
</div>
<?php $this->registerJsFile('@web/js/dir_teach.js', ['depends' => [JqueryAsset::class]]); ?>