<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $director->name;

?>

<h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
<br>
<div id="about-me">

	<div class="table-responsive">

		<?= DetailView::widget([
		    'model' => $director,
		    'attributes' => [
				[
					'attribute' => 'image',
					'label' => '',
					'format' => 'html',
					'value' => function($data) {
						return '<a href="' . $data->image . '" title="' . $data->name . '" class="fancybox" rel="gallery">
									<img src="' . $data->image . '" alt="' . $data->username . '" class="user_image">
								</a>';
					}
				],
				[
					'attribute' => 'id',
					'label' => 'ID',
				],
				[
					'attribute' => 'name',
					'label' => 'Ім\'я',
				],
				[
	                'attribute' => 'fio',
	                'label' => 'П.І.Б.',
	            ],
				[
	                'attribute' => 'birthday',
	                'format' => 'html',
	                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
	                'value' => function($data) {

	                    return myDate('ua', $data->birthday) . ' - (' . age($data->birthday) . ')';
	                }
	            ],
				[
	                'attribute' => 'type',
	                'format' => 'html',
	                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
	                'value' => function($data) {
	                    return '<span class="my-btn btn-' . $data->type . '">' . $data->custom_type . '</span>';
	                }
	            ],
				[
					'attribute' => 'phone',
					'label' => 'Телефон',
					'format' => 'html',
					'value' => function($data) {
						if (!$data->phone) {
							return '<span class="not-set">(не задано)</span>';
						} else {
							return '<a href="tel:' . $data->phone . '">' . $data->phone . '</a>';
						}
					}
				],
				[
					'attribute' => 'telegram_chat_id',
					'label' => 'Telegram Chat ID',
					'format' => 'html',
					'value' => function($data) {
						if (!$data->telegram->telegram_chat_id) {
							return '<span class="not-set">(не задано)</span>';
						} else {
							return '<span class="telegram_color span_telegram_chat_id">' . $data->telegram->telegram_chat_id . '</span>';
						}
					}
				],
				[
					'attribute' => 'region',
					'label' => 'Область',
					'value' => $director->region->name
				],
				[
					'attribute' => 'city',
					'label' => 'Місто',
					'value' => $director->city->name
				],
				[
					'attribute' => 'school',
					'label' => 'Школа',
					'value' => $director->school->name,
				],
				[
					'attribute' => 'subject',
					'label' => 'Профільний предмет',
					'value' => $director->subject->subject,
					'visible' => ($director->type == 'teacher' || $director->type == 'director' && $director->subject->subject) ? true : false,
				],
		    ],
		]); ?>

	</div>

</div>