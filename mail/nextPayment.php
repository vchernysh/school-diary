<?php 

use yii\helpers\Url;

?>
<br>
<div style="margin-left:20px;">

	<h1>Шановний клієнте, Вас вітає технічна підтримка системи School Diary ©</h1>

	<p><strong><?= $user['name'] ?></strong>! Нагадуємо Вам, що через <strong><?= $when ?></strong> (<strong><?= $date ?></strong>) закінчується термін користування послугами електронної системи <strong>School Diary</strong>. Щоб продовжити користування послугами, Вам необхідно мати <strong><?= $user['price'] ?><?= $user['currency'] ?></strong> та оплатити через сторінку на сайті, посилання якої буде доступне <strong><?= $date ?></strong>:<br><?= Url::to(['/payments'], true) ?><br><br>Технічна підтримка <strong>School Diary</strong> ©</p>

</div>
<br>