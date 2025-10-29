<?php 

use yii\web\JqueryAsset;

$this->registerCssFile('@web/css/Chart.min.css');
$this->registerCssFile('@web/css/my_chart.css');

?>

<button class="btn btn-danger btn-chart">Оцінки у вигляді графіка</button>
<div class="wrap-chart-block">
	<br>
	<br>
	<br>
	<div class="chart-container">
	    <canvas id="chart"></canvas>
	</div>
	<br>
</div>
<?php

	$data_labels = [];
	$data_user_marks = [];
	$user_marks = [];
	foreach($marks as $key => $value) :
		foreach($value as $k => $v) :
			foreach($v as $kk => $vv) :
				if ($kk == Yii::$app->user->identity->id) :
					$data_user_marks[$key][] = $vv['mark'];
				endif;
			endforeach;
		endforeach;
	endforeach;
	foreach($data_user_marks as $key => $value) :
		$data_labels[] = myDate('ua', $key);
		foreach($value as $k => $v) :
			$user_marks[$key][] = $v[0];
		endforeach;
	endforeach;
	foreach($user_marks as $key => $value) :
		$marks_array[$key] = $value[0];
	endforeach;
	$data = implode('\', \'', $marks_array);
	$labels = implode('\', \'', $data_labels);

$this->registerJs("
	$(document).ready(function() {

		$('.btn-chart').click(function() {
			$('.wrap-chart-block').slideToggle(400);
		});


		var data = {
		  labels: ['" . $labels . "'],
		  datasets: [{
		    label: '" . $current_student_name . "',
		    backgroundColor: 'rgba(255,99,132,0)',
		    borderColor: 'rgba(255,99,132,1)',
		    borderWidth: 2,
		    hoverBackgroundColor: false,
		    hoverBackgroundColor: 'rgba(255, 99, 132, 0.4)',
		    hoverBorderColor: 'rgba(255, 255, 0, 1)',
		    hoverBorderColor: false,
		   	data: ['" . $data . "'],
		  }]
		};
		var i = 0;
		var options = {
		  maintainAspectRatio: false,
		  legend: false,
		  scales: {
		    yAxes: [{
		      stacked: true,
		      gridLines: {
		        display: true,
		        color: 'rgba(255,99,132,0.2)'
		      }
		    }],
		    xAxes: [{
		      gridLines: {
		        display: true
		      }
		    }]
		  }
		};

		new Chart('chart', {
		    type: 'line',
		    options: options,
		  	data: data
		});

	});

"); ?>

<?php $this->registerJsFile('@web/js/Chart.min.js', ['depends' => [JqueryAsset::class]]); ?>
<?php $this->registerJsFile('@web/js/Chart.bundle.min.js', ['depends' => [JqueryAsset::class]]); ?>