<?php 

use yii\helpers\Html;

?>

<?php if ($marks_of_date) { ?>

	<br>
	<div class="form-group">
	    <?= Html::submitButton('Зберегти оцінки', ['class' => 'btn btn-success save-marks-submit-button', 'name' => 'save-marks-submit-button', 'value' => 'true']) ?>
	</div>
	<?= Html::hiddenInput('date', $search_date); ?>
	<div class="breadcrumb">
		<?= $subject->subject_name . ' - ' . myDate('ua', $search_date) ?> - <?= myDayOfWeek('ua', $search_date) ?>
	</div>
	<div class="table-responsive table-resp-border">
	    <table class="table table-bordered table-striped marks-table">
	      <thead>
	      	<tr>
		      	<th style="text-align: center; font-size: 15px;">Учень</th>
		      	<?php foreach($marks_of_date as $date => $value) { ?>
		            <?php for($th = 0; $th < $columns; $th++) { ?>
		              <?php if (empty(array_keys($value)[$th])) { ?>
		                <th class="add-marks-column">
					      	<?= Html::dropDownList('marks_info[' . $th . ']', '0', $titles, ['class' => 'form-control mark_type_title', 'data' => ['number-column' => $th]]); ?>
				        </th>
		              <?php } else { ?>
		              	<th class="add-marks-column">
					      	<?= Html::dropDownList('marks_info[' . $th . ']', array_keys($value)[$th], $titles, ['class' => 'form-control mark_type_title', 'data' => ['number-column' => $th]]); ?>
					      	<?php unset($titles[array_keys($value)[$th]]); ?>
				        </th>
		              <?php } ?>
		            <?php } ?>
		        <?php } ?>

		        <th class="add-marks-column">
		        	<span class="new-marks-little-description">Нова колонка</span>
			      	<?= Html::dropDownList('marks_info[' . $columns . ']', '0', $titles, ['class' => 'form-control mark_type_title', 'data' => ['number-column' => $columns]]); ?>
		        </th>
	    	</tr>
	      </thead>
	      <tbody>
	        <?php foreach($students as $id => $student_name) : ?>
	          <tr>
	          	<td><span class="student_name_span" data-student-id="<?= $id ?>"><?= $student_name ?></span></td>
	          	<?php $k = 2; foreach($marks_of_date as $date => $value) { ?>
	              <?php for ($td = 0; $td < $columns; $td++) { ?>
	                <?php $key = (array_keys($value)[$td]) ? array_keys($value)[$td] : 0; ?>

	                <?php if (count($value[$key][$id]['mark']) == 0) { ?>
	                  <td data-number-column="<?= $k ?>">
	                  	<?= Html::dropDownList('marks_info[' . $id . '][' . $td . '][mark]', '', $marks, ['class' => 'form-control']); ?>
	                  	<?= Html::hiddenInput('marks_info[' . $id . '][' . $td . '][student_id]', $id); ?>
	                  	<?= Html::hiddenInput('marks_info[' . $id . '][' . $td . '][type_mark]', (array_keys($value)[$td]) ? array_keys($value)[$td] : '0', ['class' => 'hidden_type_mark_' . $td]); ?>
	                  </td>
	                <?php } else { ?>
	                  <td data-number-column="<?= $k ?>">
						<?= Html::dropDownList('marks_info[' . $id . '][' . $td . '][mark]', $value[$key][$id]['mark'][0], $marks, ['class' => 'form-control']); ?>
						<?= Html::hiddenInput('marks_info[' . $id . '][' . $td . '][student_id]', $id); ?>
						<?= Html::hiddenInput('marks_info[' . $id . '][' . $td . '][id]', $value[$key][$id]['id'][0]); ?>
						<?= Html::hiddenInput('marks_info[' . $id . '][' . $td . '][type_mark]', (array_keys($value)[$td]) ? array_keys($value)[$td] : '0', ['class' => 'hidden_type_mark_' . $td]); ?>
	                    <?php 
	                      unset($value[$key][$id]['mark'][0]);
	                      unset($value[$key][$id]['id'][0]);
	                      $value[$key][$id]['mark'] = array_values($value[$key][$id]['mark']);
	                      $value[$key][$id]['id'] = array_values($value[$key][$id]['id']);
	                    ?>
	                  </td>
	                <?php } ?>
	              <?php } ?>
	            <?php $k++; } ?>
	            <td data-number-column="<?= $k ?>">
	            	<?= Html::dropDownList('marks_info[' . $id . '][' . $columns . '][mark]', '', $marks, ['class' => 'form-control']); ?>
                  	<?= Html::hiddenInput('marks_info[' . $id . '][' . $columns . '][student_id]', $id); ?>
                  	<?= Html::hiddenInput('marks_info[' . $id . '][' . $columns . '][type_mark]', '0', ['class' => 'hidden_type_mark_' . $columns]); ?>
	            </td>
	          </tr>
	        <?php endforeach; ?>
	      </tbody>
	    </table>
	</div>
	<br>
	<div class="form-group">
	    <?= Html::submitButton('Зберегти оцінки', ['class' => 'btn btn-success save-marks-submit-button', 'name' => 'save-marks-submit-button', 'value' => 'true']) ?>
	</div>

<?php } else { ?>

	<h4><?= Html::encode('Оцінок станом на ' . myDate('ua', $search_date) . ' року немає. Виставіть хоча б одну.') ?></h4>
	<br>
	<div class="form-group">
	    <?= Html::submitButton('Зберегти оцінки', ['class' => 'btn btn-success save-marks-submit-button', 'name' => 'save-marks-submit-button', 'value' => 'true']) ?>
	</div>
	<?= Html::hiddenInput('date', $search_date); ?>
	<div class="breadcrumb">
		<?= $subject->subject_name . ' - ' . myDate('ua', $search_date) ?> - <?= myDayOfWeek('ua', $search_date) ?>
	</div>
	<div class="table-responsive table-resp-border">
	    <table class="table table-bordered table-striped marks-table">
	      <thead>
	      	<tr>
		      	<th style="text-align: center; font-size: 15px;">Учень</th>
		      	<th class="add-marks-column">
		      		<span class="new-marks-little-description">Нова колонка</span>
			      	<?= Html::dropDownList('marks_info[0]', '0', $titles, ['class' => 'form-control mark_type_title', 'data' => ['number-column' => '0']]); ?>
		        </th>
		        <th class="add-marks-column">
		        	<span class="new-marks-little-description">Нова колонка</span>
			      	<?= Html::dropDownList('marks_info[1]', '0', $titles, ['class' => 'form-control mark_type_title', 'data' => ['number-column' => '1']]); ?>
		        </th>
	    	</tr>
	      </thead>
	      <tbody>
	        <?php foreach($students as $id => $student_name) : ?>
	          <tr>
	          	<td><span class="student_name_span" data-student-id="<?= $id ?>"><?= $student_name ?></span></td>
	            <td data-number-column="0">
	            	<?= Html::dropDownList('marks_info[' . $id . '][0][mark]', '', $marks, ['class' => 'form-control']); ?>
                  	<?= Html::hiddenInput('marks_info[' . $id . '][0][student_id]', $id); ?>
                  	<?= Html::hiddenInput('marks_info[' . $id . '][0][type_mark]', '0', ['class' => 'hidden_type_mark_0']); ?>
	            </td>
	            <td data-number-column="1">
	            	<?= Html::dropDownList('marks_info[' . $id . '][1][mark]', '', $marks, ['class' => 'form-control']); ?>
                  	<?= Html::hiddenInput('marks_info[' . $id . '][1][student_id]', $id); ?>
                  	<?= Html::hiddenInput('marks_info[' . $id . '][1][type_mark]', '0', ['class' => 'hidden_type_mark_1']); ?>
	            </td>
	          </tr>
	        <?php endforeach; ?>
	      </tbody>
	    </table>
	</div>
	<br>
	<div class="form-group">
	    <?= Html::submitButton('Зберегти оцінки', ['class' => 'btn btn-success save-marks-submit-button', 'name' => 'save-marks-submit-button', 'value' => 'true']) ?>
	</div>
<?php } ?>