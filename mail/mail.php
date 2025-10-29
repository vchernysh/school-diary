<?php 

use yii\helpers\Url;

?>
<br>
<div style="margin-left:20px;">

	<h1><?= $data['type_message'] ?></h1>

	<p>Ви отримали повідомлення в технічну підтримку на сайті <a href="<?= Url::home(true); ?>" target="_blank">School Diary</a></p>
	<br>
	<p><b>ID користувача: </b> <?= $data['user_id'] ?></p>
	<p><b>Ім'я: </b> <?= $data['name']  ?></p>
	<p><b>Логін: </b> <?= $data['username'] ?></p>
	<p><b>Email: </b> <?= $data['email'] ?></p>
	<p><b>Phone: </b> <?= $data['phone'] ?></p>
	<p><b>Telegram ID: </b> <?= $data['telegram'] ?></p>
	<p><b>Тип користувача: </b> <?= $data['user_type'] ?></p>
	<p><b>Область: </b> <?= $data['region'] ?></p>
	<p><b>Місто: </b> <?= $data['city'] ?></p>
	<p><b>Школа: </b> <?= $data['school'] ?></p>
	<p><b>Повідомлення: </b> <?= nl2br($data['message']) ?></p>

</div>
<br>