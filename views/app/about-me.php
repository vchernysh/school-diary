<?php

use yii\helpers\{Html, Url};
use yii\widgets\DetailView;

?>

<h1 class="h1-title"><?= Html::encode($user->name) ?></h1>
<p>
	<?= Html::a('Змінити інформацію про себе', [Url::to(['/change-info-about-me'], false)], ['class' => 'btn btn-primary']) ?>
</p>
<br>
<div id="about-me">

	<div class="table-responsive">

		<?= DetailView::widget([
		    'model' => $user,
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
					'attribute' => 'username',
					'label' => 'Логін',
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
					'attribute' => 'email',
					'label' => 'Email',
					'format' => 'email',
				],
				[
					'attribute' => 'send_mail',
					'format' => 'html',
					'value' => function($data)
					{
						$html = '';
						if ($data->send_mail == 1) {
							$html = '<span class="my-btn btn-no">Так</span>';
						} else {
							$html = '<span class="my-btn btn-yes">Ні</span>';
						}
						return $html;
					}
				],
				[
	                'attribute' => 'birthday',
	                'format' => 'html',
	                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
	                'value' => function($data) {
	                    if (!$data->birthday) {
	                        return '<span class="not-set">(не задано)</span>';
	                    } else {
	                        return myDate('ua', $data->birthday) . ' - (' . age($data->birthday) . ')';
	                    }
	                }
	            ],
				[
	                'attribute' => 'type',
	                'format' => 'html',
	                'contentOptions' => ['style' => ['vertical-align' => 'middle']],
	                'value' => function($data) {
	                    $html = '<span class="my-btn btn-' . $data->type . '">' . Yii::$app->controller->user_type . '</span>';
	                    if ($data->type == 'parent')
	                    {
	                    	$html .= ' <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <span class="my-btn btn-' . $data->parent->type . '">' . $data->parent->custom_type . '</span>';
	                    }
	                    return $html;
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
					'label' => 'Telegram ID',
					'format' => 'html',
					'value' => function($data) {
						if (!$data->telegram->telegram_chat_id) {
							return '<span class="not-set">(не задано)</span>';
						} else {
							$html = '<span class="telegram_color span_telegram_chat_id">' . $data->telegram->telegram_chat_id . '</span>';

							if (Yii::$app->controller->school__payment_type == 'single') {

								if ($data->type == 'student' || $data->type == 'parent') {
									if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()))
									{
										$html .= ' <a href="' . Url::to(['/change-telegram-id']) . '" class="btn change_telegram_chat_id_btn">Змінити Telegram ID</a>';
										if (Yii::$app->controller->telegram_status == 'pending') {
											$html .= '<a href="' . Url::to(['/close-change-telegram-id']) . '" class="btn btn-success save_telegram_chat_id_btn">Зберегти Telegram ID</a>';
										}
									}
								} else {
									$html .= ' <a href="' . Url::to(['/change-telegram-id']) . '" class="btn change_telegram_chat_id_btn">Змінити Telegram ID</a>';
									if (Yii::$app->controller->telegram_status == 'pending') {
										$html .= '<a href="' . Url::to(['/close-change-telegram-id']) . '" class="btn btn-success save_telegram_chat_id_btn">Зберегти Telegram ID</a>';
									}
								}

							} elseif (Yii::$app->controller->school__payment_type == 'all') {
								if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time()))
								{
									$html .= ' <a href="' . Url::to(['/change-telegram-id']) . '" class="btn change_telegram_chat_id_btn">Змінити Telegram ID</a>';
									if (Yii::$app->controller->telegram_status == 'pending') {
										$html .= '<a href="' . Url::to(['/close-change-telegram-id']) . '" class="btn btn-success save_telegram_chat_id_btn">Зберегти Telegram ID</a>';
									}
								}
							}
							
							
							return $html;
						}
					}
				],
				[
					'attribute' => 'region',
					'label' => 'Область',
					'value' => $user->region->name
				],
				[
					'attribute' => 'city',
					'label' => 'Місто',
					'value' => $user->city->name
				],
				[
					'attribute' => 'school',
					'label' => 'Школа',
					'value' => $user->school->name,
				],
				[
					'attribute' => 'my_child',
					'format' => 'html',
					'label' => 'Дитина',
					'value' => Html::a($user->children->name, Url::to(['/parents/my-class/students/view', 'id' => $user->children->user_id])),
					'visible' => ($user->type == 'parent' && Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()) ? true : false,
				],
				[
					'attribute' => 'subject',
					'label' => 'Профільний предмет',
					'value' => $user->subject->subject,
					'visible' => ($user->type == 'teacher' || $user->type == 'director' && $user->subject->subject) ? true : false,
				],
				[
					'attribute' => 'class',
					'label' => 'Клас',
					'format' => 'html',
					'value' => function($data) {
						if ($data->type == 'student')
						{
							if (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()) {
								return Html::a($data->student_class->name, Url::to(['/students/my-class/settings/index']));
							} else {
								return $data->student_class->name;
							}
						} elseif ($data->type == 'parent') {
							if (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()) {
								return Html::a($data->children->class->name, Url::to(['/parents/my-class/settings/index']));
							} else {
								return $data->children->class->name;
							}
						} elseif ($data->type == 'teacher') {
							return Html::a($data->class->name, Url::to(['/teachers/my-class/settings/index']));
						}
					},
					'visible' => ($user->type == 'student' || $user->type == 'teacher' || $user->type == 'parent') ? true : false,
				],
				[
					'attribute' => 'class_teacher',
					'label' => 'Класний керівник',
					'format' => 'html',
					'value' => function($data) {
						if ($data->type == 'student') {
							if ($payment_check) {
								return Html::a($data->classTeacher->name, Url::to(['/students/teachers/view/' . $data->classTeacher->id]));
							} else {
								return $data->classTeacher->name;
							}
						} elseif ($data->type == 'parent') {
							if ($payment_check) {
								return Html::a($data->classTeacher->name, Url::to(['/parents/teachers/view/' . $data->classTeacher->id]));
							} else {
								return $data->classTeacher->name;
							}
						}
					},
					'visible' => ($user->type == 'student' || $user->type == 'parent') ? true : false,
				],
				[
					'attribute' => 'my_parents',
					'format' => 'html',
					'label' => 'Мої батьки',
					'value' => Html::a('Мої батьки', Url::to(['/students/my-class/my-parents/index']), ['class' => 'btn btn-primary']),
					'visible' => ($user->type == 'student' && Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()) ? true : false,
				],
				[
					'attribute' => 'director',
					'label' => 'Директор',
					'format' => 'html',
					'value' => function($data) {
						if ($data->type == 'parent' || $data->type == 'student') {
							if (Yii::$app->controller->school__payment_type == 'all') {
								if (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time()) {
									return Html::a($data->director->name, Url::to(['/info-about-director']));
								} else {
									return $data->director->name;
								}
							} elseif (Yii::$app->controller->school__payment_type == 'single') {
								if (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()) {
									return Html::a($data->director->name, Url::to(['/info-about-director']));
								} else {
									return $data->director->name;
								}
							}
						} else {
							return Html::a($data->director->name, Url::to(['/info-about-director']));
						}
					},
					'visible' => ($user->type != 'admin' && $user->type != 'director') ? true : false,
				],
				[
					'attribute' => 'my_family',
					'format' => 'html',
					'label' => 'Моя сім\'я',
					'value' => function($data) {
						if ($data->type == 'parent') {
							if (Yii::$app->controller->school__payment_type == 'all') {
								if (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time()) {
									return Html::a('Моя сім\'я', Url::to(['/parents/my-family/index']), ['class' => 'btn btn-primary']);
								} else {
									return '<i class="not-set">Не задано</i>';
								}
							} elseif (Yii::$app->controller->school__payment_type == 'single') {
								if (Yii::$app->user->identity->paymentOfUser && Yii::$app->user->identity->paymentOfUser['max_date'] > time()) {
									return Html::a('Моя сім\'я', Url::to(['/parents/my-family/index']), ['class' => 'btn btn-primary']);
								} else {
									return '<i class="not-set">Не задано</i>';
								}
							}
						} else {
							return '<i class="not-set">Не задано</i>';
						}
					},
					'visible' => ($user->type == 'parent') ? true : false,
				],
		    ],
		]); ?>

	</div>

</div>