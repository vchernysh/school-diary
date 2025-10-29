<?php

use Yii;
	use yii\helpers\Html;

?>
<div id="telegram_block">
	<h4><b style="color: #F00;">‼‼‼</b> Щоб збереження було успішно завершено, необхідно бути авторизованим у системі <b><?= Html::a('School Diary', Yii::$app->homeUrl, ['target' => '_blank']) ?></b>.</h4>
	<br>
	<h3>Інструкція щодо збереження Telegram ID у системі School Diary:</h3>


	<p>Щоб отримувати миттєво повідомлення з системи <b>School Diary</b> у <b class="telegram_color">Telegram</b>, необхідно перейти до <a href="https://teleg.run/SchoolDiarySaveID_bot?start=<?= Yii::$app->user->identity->username ?>" target="_blank" class="school_diary_bot">School Diary Bot 🤖</a> і зберегти свій <b>Telegram ID</b>.</p>

	<h3>Послідовність дій:</h3>
	<p>Послідовність дій наведена з ноутбука/комп'ютера та мобільного телефону.</p>
	<ul class="telegram_ul">
		<li><span>Перейдіть за наступним посиланням <a style="word-break: break-word;" href="https://teleg.run/SchoolDiarySaveID_bot?start=<?= Yii::$app->user->identity->username ?>" target="_blank" class="school_diary_bot">https://teleg.run/SchoolDiarySaveID_bot?start=<?= Yii::$app->user->identity->username ?></a></span><br><br>
			<div class="et">
				<i>Результат (ноутбук/комп'ютер)</i><br>
				<a href="/images/empty_telegram/t_d_1.png" title="Результат (ноутбук/комп'ютер)" class="fancybox" rel="gallery_1">
		            <img src="/images/empty_telegram/t_d_1.png" alt="" class="img-responsive"><br>
		        </a>
				<i>Результат (мобільний телефон)</i><br>
				<a href="/images/empty_telegram/t_m_1.jpg" title="Результат (мобільний телефон)" class="fancybox" rel="gallery_1">
		            <img src="/images/empty_telegram/t_m_1.jpg" alt="" class="img-responsive">
		        </a>
			</div>
		</li>
		<br>
		<li><span>Перед Вами з'явиться чат з Ботом системи <b>School Diary</b>. Щоб розпочати роботу з Ботом, натисніть на "<b>START</b>", як указано на малюнку:</span>
			<br><br>
			<div class="et">
				<i>Результат (ноутбук/комп'ютер)</i><br>
				<a href="/images/empty_telegram/t_d_2.png" title="Результат (ноутбук/комп'ютер)" class="fancybox" rel="gallery_2">
		            <img src="/images/empty_telegram/t_d_2.png" alt="" class="img-responsive"><br>
		        </a>
				<i>Результат (мобільний телефон)</i><br>
				<a href="/images/empty_telegram/t_m_2.jpg" title="Результат (мобільний телефон)" class="fancybox" rel="gallery_2">
		            <img src="/images/empty_telegram/t_m_2.jpg" alt="" class="img-responsive">
		        </a>
			</div>
		</li>
		<br>
		<li><span>Після натиснення на кнопку "<b>START</b>" перед Вами з'явиться наступна інформація, яка вказана на малюнку:</span>
			<br><br>
			<div class="et">
				<i>Результат (ноутбук/комп'ютер)</i><br>
				<a href="/images/empty_telegram/t_d_3.png" title="Результат (ноутбук/комп'ютер)" class="fancybox" rel="gallery_3">
		            <img src="/images/empty_telegram/t_d_3.png" alt="" class="img-responsive"><br>
		        </a>
				<i>Результат (мобільний телефон)</i><br>
				<a href="/images/empty_telegram/t_m_3.jpg" title="Результат (мобільний телефон)" class="fancybox" rel="gallery_3">
		            <img src="/images/empty_telegram/t_m_3.jpg" alt="" class="img-responsive">
		        </a>
			</div>
		</li>
		<br><br>
		<li><span>Переходите за посиланням, яке вказано на малюнку, і Вас перекидує на сторінку, на якій буде успішне повідомлення про те, що Ви зберегли свій Telegram ID у системі.</span></li>
	</ul>
	
</div>