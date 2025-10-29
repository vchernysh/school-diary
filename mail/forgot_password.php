<?php 

use yii\helpers\Url;

?>
<br>
<div style="margin-left:20px;">

	<?php if ($user->type == 'student') { ?>
		<p>Привіт, <b><?= $user->name ?></b>. Я - бот системи <b>School Diary</b>. Я щойно отримав повідомлення про те, що ти хочеш відновити свій пароль для входу у систему School Diary. Якщо це ти надіслав цей запит, перейди за наступним посиланням:</p>
	<?php } else { ?> 
		<p>Привіт, <b><?= $user->name ?></b>. Я - бот системи <b>School Diary</b>. Я щойно отримав повідомлення про те, що Ви бажаєте відновити свій пароль для входу у систему School Diary. Якщо цей запит надіслали Ви, то перейдіть за наступним посиланням:</p>
	<?php } ?>
		<br>
		<p>Ваш Логін: <b><?= $user->username ?></b></p>
		<br>
		<a href="<?= Url::home(true) . 'new-password/' . $user->username . '/' . $user->id . '/' . $hash ?>"><?= Url::home(true) . 'new-password/' ?><?= $user->username ?>/<?= $user->id ?>/<?= $hash ?></a>
		<br>
		<br>
	<?php if ($user->type == 'student') { ?>
		<p>Якщо ти не надсилав ніякого запиту, просто проігноруй це повідомлення.</p>
	<?php } else { ?> 
		<p>Якщо Ви не надсилали ніякого запиту, просто проігноруйте це повідомлення.</p>
	<?php } ?>

</div>
<br>