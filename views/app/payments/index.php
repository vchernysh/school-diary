<?php 
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\web\JqueryAsset;

$this->title = 'Оплата за журнал';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

	<?php if (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()) { ?>
		
		<div class="alert alert-success">
			<strong>Ви оплатити послуги за користування журналом!</strong> Послуги доступні до <strong><?= Yii::$app->user->identity->paymentOfUser['date_to'] ?></strong>.
		</div>
	<?php } else { ?>
		<div class="alert alert-danger">
			<strong>Ви не оплатили послуги за користування журналом!</strong>
		</div>
		<code>Оплата за учня - <span class="payment-student-name-span"><?= $student_name ?></span>. Термін - до <?= myDate('ua', getDateOfNextYearIfThisDayHasNotPass('01-06')) ?>. Оплатити може будь-який член родини - чи то учень, чи то батьки, які зареєстровані у системі.</code>
		<br><br>
	<?php } ?>

	<?= $liqpay_form; ?>
	<hr>
    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <div class="table-responsive">
    	<?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        'filterModel' => $searchModel,
	        'layout' => "{summary}\n{items}\n<div class='center-align'>{pager}</div>",
            'pager' => [
                'maxButtonCount' => 5,    // Set maximum number of page buttons that can be displayed
            ],
	        'columns' => [
	        	[
	                'class' => 'yii\grid\SerialColumn',
	                'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	            ],
	            [
	            	'attribute' => 'order_id',
	            	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	            ],
	            [
	            	'attribute' => 'payment_id',
	            	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	            ],
	            [
	            	'attribute' => 'payerName',
	            	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'format' => 'html',
	                'value' => function($data) {
	                	return '<span class="span-display-block">' . $data->payerName . '</span>';
	                }
	            ],
	            [
	            	'attribute' => 'amount',
	            	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	            ],
	            [
	            	'attribute' => 'currency',
	            	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	            ],
	            [
	            	'attribute' => 'date_to',
	            	'format' => 'html',
	            	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'value' => function($data) {
	                	return '<span class="span-inline-block">' . $data->date_to . '</span>';
	                }
	            ],
	            [
	            	'attribute' => 'date_from',
	            	'format' => 'html',
	            	'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'value' => function($data) {
	                	return '<span class="span-inline-block">' . $data->date_from . '</span>';
	                }
	            ],

	            [
	                'attribute' => 'status',
	                'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'headerOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'format' => 'html',
	                'value' => function($data) {
	                    if ($data->unix_date_to > time()) {
	                        return '<span class="my-btn btn-active-payment">Активний</span>';
	                    } else {
	                        return '<span class="my-btn btn-not-active-payment">Не активний</span>';
	                    }
	                }
	            ],

	            [
	                'class' => 'yii\grid\ActionColumn',
	                'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
	                'template' => '{view}',
	                'buttons' => [
	                    'view' => function($url, $model) {
	                        return Html::a('Детальніше', ['view', 'order_id' => $model->order_id], ['class' => 'btn btn-primary']);
	                    }
	                ]
	            ],

	        ],
	    ]); ?>
    </div>
</div>







<?php $this->registerJsFile('@web/js/students_parents.js', ['depends' => [JqueryAsset::class]]); ?>