<?php

use yii\helpers\{Html, Url};
use kartik\date\DatePicker;

$this->title = 'Оцінки - ' . $subject->subject_name;
$this->params['breadcrumbs'][] = ['label' => 'Мій клас - ' . Yii::$app->user->identity->class->name . ' (Успішність <i class="fa fa-line-chart" aria-hidden="true"></i>)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="flex-block marks-flex-block">
	<?= Html::a('Додати нову оцінку', ['add-new-marks', 'subject_id' => $subject_id], ['class' => 'btn btn-success']); ?>
	<label class="label-control inline-label">Предмети: <span class="span-subject-marks-loading"></span></label>
	<?= Html::dropDownList('subject', $subject_id, $subjects, ['class' => 'form-control select-subject-marks', 'onchange' => '
		$.post("/directors/teachers/my-class/rating/marks?subject_id='.'"+$(this).val());
	']) ?>
</div>
<br>

<?php if ($marks) { ?>
  
  <div class="form-group filter-search-marks-wrap-block">
    <form action="" method="post" class="filter-search-marks-wrap-form">
      <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>">
      <div class="row">
        <div class="col-md-12 flex-block">
          <?= Html::submitButton('Показати оцінки за період', ['class' => 'btn btn-primary show-marks-by-filter-btn', 'name' => 'filter-search-submit-button', 'value' => 'true']) ?>
          <?php if (Yii::$app->request->get('from') || Yii::$app->request->get('to')) { ?>
            <?= Html::a('Показати всі оцінки без фільтрів', Url::to(['marks', 'subject_id' => $subject_id]), ['class' => 'btn btn-warning all-marks-without-filters']) ?>
          <?php } ?>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 flex-block">
          <label class="control-label">Від: </label>
          <?= DatePicker::widget([
            'value' => (Yii::$app->request->get('from')) ?? '',
            'name' => 'date_from',
            'options' => ['placeholder' => 'дд-мм-рррр', 'class' => 'date_sheet_marks_from'],
            'pluginOptions' => [
              'format' => 'dd-mm-yyyy',
              'todayHighlight' => true,
              'autoclose' => true,
              'endDate' => '0d',
            ]
          ]); ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 flex-block">
          <label class="control-label">До: </label>
          <?= DatePicker::widget([
            'value' => (Yii::$app->request->get('to')) ?? '',
            'name' => 'date_to',
            'options' => ['placeholder' => 'дд-мм-рррр', 'class' => 'date_sheet_marks_to'],
            'pluginOptions' => [
              'format' => 'dd-mm-yyyy',
              'todayHighlight' => true,
              'autoclose' => true,
              'endDate' => '0d',
            ]
          ]); ?>
        </div>
      </div>
    </form>
  </div>

  <h1 class="h1-title"><?= Html::encode($subject->subject_name) ?></h1>
  <div class="table-responsive table-resp-border">
    <table class="table table-bordered table-striped marks-table">
      <thead>
        <tr class="head-tr">
          <th class="student_name" rowspan="2">ПІБ учня</th>
          <?php $i = 2; foreach($marks as $date => $value) { ?>
            <th colspan="<?= $colspan_number[$date] ?>" data-date-number="<?= $i ?>"><?= date('d.m.Y', $date) ?><br><span class="week-day-span"><?= myDayOfWeek('ua', $date) ?></span></th>
          <?php $i++; } ?>
          <th colspan="2">Пропусків</th>
        </tr>
        <tr class="head-tr">
          <?php foreach($marks as $date => $value) { ?>
            <?php for($th = 0; $th < $colspan_number[$date]; $th++) { ?>
              <?php if (empty(array_keys($value)[$th])) { ?>
                <th></th>
              <?php } else { ?>
                <th class="under-title-marks-table"><span class="span-for-tooltip"><?= $titles[array_keys($value)[$th]] ?></span></th>
              <?php } ?>
            <?php } ?>
          <?php } ?>
          <th data-was-cell="wn"><span style="display: block; min-width: 60px;">Не було</span></th>
          <th data-was-cell="ws"><span style="display: block; min-width: 70px;">По хворобі</span></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($students as $id => $name) : ?>
          <tr class="my_tr" title="<?= $name ?>">
            <td><span class="student_name_span" data-student-id="<?= $id ?>"><?= $name ?></span></td>
            <?php $i = 2; foreach($marks as $date => $value) { ?>
              <?php for ($td = 0; $td < $colspan_number[$date]; $td++) { ?>
                <?php $key = (array_keys($value)[$td]) ? array_keys($value)[$td] : 0; ?>

                <?php if (count($value[$key][$id]['mark']) == 0) { ?>
                  <td data-number-column="<?= $i ?>"></td>
                <?php } else { ?>
                  <td data-number-column="<?= $i ?>">
                    <?php if ($value[$key][$id]['mark'][0] == 'н') { ?>
                      <span class="btn btn-was-not" data-toggle="tooltip" title="Не було"><?= $value[$key][$id]['mark'][0] ?></span>
                    <?php } elseif ($value[$key][$id]['mark'][0] == 'хв') { ?>
                      <span class="btn btn-was-sick" data-toggle="tooltip" title="Хворий"><?= $value[$key][$id]['mark'][0] ?></span>
                    <?php } else {
                      if ($value[$key][$id]['mark'][0] <= 4) {
                        echo '<span class="bad_mark">' . $value[$key][$id]['mark'][0] . '</span>';
                      } else {
                        echo $value[$key][$id]['mark'][0];
                      }
                    } ?>
                    <?php 
                      unset($value[$key][$id]['mark'][0]); 
                      $value[$key][$id]['mark'] = array_values($value[$key][$id]['mark']);
                    ?>
                  </td>
                <?php } ?>

              <?php } ?>
              
            <?php $i++; } ?>
            <td class="was-not-bg" data-was-not="wn"><?= ($student_skips['was_not'][$id]) ? $student_skips['was_not'][$id] : '0'; ?></td>
            <td class="was-not-bg" data-was-not="ws"><?= ($student_skips['was_sick'][$id]) ? $student_skips['was_sick'][$id] : '0'; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php } else { ?>

  <div class="form-group filter-search-marks-wrap-block">
    <form action="" method="post" class="filter-search-marks-wrap-form">
      <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken(); ?>">
      <div class="row">
        <div class="col-md-12 flex-block">
          <?= Html::submitButton('Показати оцінки за період', ['class' => 'btn btn-primary show-marks-by-filter-btn', 'name' => 'filter-search-submit-button', 'value' => 'true']) ?>
          <?php if (Yii::$app->request->get('from') || Yii::$app->request->get('to')) { ?>
            <?= Html::a('Показати всі оцінки без фільтрів', Url::to(['marks', 'subject_id' => $subject_id]), ['class' => 'btn btn-warning all-marks-without-filters']) ?>
          <?php } ?>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 flex-block">
          <label class="control-label">Від: </label>
          <?= DatePicker::widget([
            'value' => (Yii::$app->request->get('from')) ?? '',
            'name' => 'date_from',
            'options' => ['placeholder' => 'дд-мм-рррр', 'class' => 'date_sheet_marks_from'],
            'pluginOptions' => [
              'format' => 'dd-mm-yyyy',
              'todayHighlight' => true,
              'autoclose' => true,
              'endDate' => '0d',
            ]
          ]); ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 flex-block">
          <label class="control-label">До: </label>
          <?= DatePicker::widget([
            'value' => (Yii::$app->request->get('to')) ?? '',
            'name' => 'date_to',
            'options' => ['placeholder' => 'дд-мм-рррр', 'class' => 'date_sheet_marks_to'],
            'pluginOptions' => [
              'format' => 'dd-mm-yyyy',
              'todayHighlight' => true,
              'autoclose' => true,
              'endDate' => '0d',
            ]
          ]); ?>
        </div>
      </div>
    </form>
  </div>

  <?php 
    $from_not = '';
    $to_not = '';
    if (Yii::$app->request->get('from')) {
      $from_not = ' від <code>' . Yii::$app->request->get('from') . '</code>';
    }
    if (Yii::$app->request->get('to')) {
      $to_not = ' до <code>' . Yii::$app->request->get('to') . '</code>';
    }
  ?>
  <h3>Оцінок з предмету "<?= Html::encode($subject->subject_name) ?>" <?= $from_not . $to_not ?> немає</h3>
<?php } ?>
