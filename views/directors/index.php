<?php use yii\helpers\Url; ?>

<div class="directors-index">
    
    <?php if (Yii::$app->controller->school__payment_type == 'all') {
    	if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time())) { ?>
    		<br>
		    <h1 class="h1-title h1-title-index"><?= Yii::$app->user->identity->school->name ?></h1>
		    <br>
    	<?php } ?> 
    <?php } elseif (Yii::$app->controller->school__payment_type == 'single') { ?>
		<br>
	    <h1 class="h1-title h1-title-index"><?= Yii::$app->user->identity->school->name ?></h1>
	    <br>
	<?php } ?>

    <div class="body-content">

    	<?php if (Yii::$app->controller->school__payment_type == 'all') {
	    	if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time())) { ?>
	    		<?= $school['info'] ?>
	    	<?php } else { ?>
	    		<p class="text-danger">Користування електронним журналом <strong>School Diary</strong> на даний момент неможливе. Ви не сплатили кошти - <strong><?= number_format(Yii::$app->user->identity->school->price_for_all_school, 2, ',', ' ') ?> <?= Yii::$app->user->identity->school->currency->name?></strong>.</p>
	    		<p class="text-danger">Максимальна доступна кількість учнів для реєстрації - <strong><?= number_format(Yii::$app->user->identity->school->max_students, 0, ',', ' ') ?></strong>.</p>
	    	<?php } ?>
	    <?php } elseif (Yii::$app->controller->school__payment_type == 'single') { ?>
			<?= $school['info'] ?>
		<?php } ?>

    </div>
</div>
