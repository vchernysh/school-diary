<?php 

use yii\helpers\Url;

?>
<br>
<div style="margin-left:20px;">

	<h1><?= $data['type_message'] ?></h1>

	<p>Ви отримали відповідь від технічної підтримки на сайті <a href="<?= Url::home(true); ?>" target="_blank">School Diary</a></p>
	<br>
	<p><b>Повідомлення: </b> <?= nl2br($data['message']) ?></p>

</div>
<br>