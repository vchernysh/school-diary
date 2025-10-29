<div id="wrap_payment_block">
	<form action="" method="POST" id="liqpay-form" accept-charset="utf-8">
		<input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam ?>" value="<?= Yii::$app->getRequest()->getCsrfToken() ?>">
		<input type="hidden" name="data" id="data">
		<input type="hidden" name="signature" id="signature">
		<button type="submit" class="button_liqpay send_button_request_liqpay">
			<img src="/images/liqpay-logo-small.png" class="liqpay-logo-small">
			<span>Сплатити <?= $amount ?> <?= $currency ?></span>
		</button>
	</form>
</div>