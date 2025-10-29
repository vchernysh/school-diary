<?php use yii\helpers\Url; ?>

<div class="students-index">

	<?php if (Yii::$app->controller->school__payment_type == 'all') {
    	if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time())) { ?>
    		<br>
		    <h1 class="h1-title h1-title-index"><?= Yii::$app->user->identity->school->name ?></h1>
		    <br>
    	<?php } ?> 
    <?php } elseif (Yii::$app->controller->school__payment_type == 'single') { ?>
		<?php if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time())) { ?>
		    <br>
		    <h1 class="h1-title h1-title-index"><?= Yii::$app->user->identity->school->name ?></h1>
		    <br>
		<?php } ?>
	<?php } ?>

    <div class="body-content">

    	<?php if (Yii::$app->controller->school__payment_type == 'all') {
	    	if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time())) { ?>
	    		<?= $school['info'] ?>
	    	<?php } else { ?>
	    		<p class="text-danger">Користування електронним журналом <strong>School Diary</strong> на даний момент неможливе. Керівництво Вашого навчального закладу не сплатило кошти. Очікуйте.</p>
	    	<?php } ?>
	    <?php } elseif (Yii::$app->controller->school__payment_type == 'single') { ?>
			<?php if (Yii::$app->user->identity->school->is_test == 'no' && (!Yii::$app->user->identity->paymentOfUser || Yii::$app->user->identity->paymentOfUser['max_date'] < time())) { ?>
	    		<div class="alert alert-danger">
					<strong>Ви не оплатили послуги за користування журналом!</strong> Щоб оплатити, перейдіть за посиланням: <strong><a href="<?= Url::to(['/payments']) ?>"><?= Url::to(['/payments'], true) ?></a></strong>
				</div>
	    	<?php } else { ?>
	    		<?= $school['info'] ?>
	    	<?php } ?>
		<?php } ?>

    </div>
</div>
