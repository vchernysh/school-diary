<?php

use Yii;
    use yii\helpers\{Html, Url};

/* @var $this yii\web\View */

$this->title = 'Тема листа: ' . $type;
$this->params['breadcrumbs'][] = ['label' => 'Запитання в технічну підтримку', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="questions-view support_chat">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <hr>
    <p>
        <?= Html::a(($question->status == 'opened') ? 'Закрити' : 'Відкрити', ['status', 'id' => $question->id], [
            'class' => ($question->status == 'opened') ? 'btn btn-closed' : 'btn btn-opened',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php if (count($model) >= 9) { ?>
    	<span class="fa-stack icon_press_to_bottom fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-angle-down fa-stack-1x fa-inverse"></i>
		</span>
    <?php } ?>

    <div class="messaging">
        <div class="inbox_msg">
            <div class="mesgs">
                <div class="msg_history">
                <?php $i = 1; foreach($model as $answer) : ?>

                    <?php if ($answer->type_answer == 'user') { ?>
                        <div class="incoming_msg">
                            <div class="incoming_msg_img">
                                <a href="<?= Url::to(['/admins/user/view', 'id' => $answer->user->id]) ?>" title="<?= $answer->user->username ?> - <?= $answer->user->custom_type ?>" target="_blank">
                                    <img src="<?= Url::to([$answer->user->image]) ?>" alt="<?= $answer->user->username ?>">
                                </a>
                            </div>
                            <div class="received_msg">
                                <div class="received_width_msg">
                                    <p><?= nl2br($answer->message) ?></p>
                                    <span class="time_date"><?= myTime('H', $answer->date) . ' | ' . myDate('ua', $answer->date) ?> | <a href="<?= Url::to(['/admins/user/view', 'id' => $answer->user->id]) ?>" target="_blank"><i style="color:#000; font-style:normal;"><?= $answer->user->name ?></i></a></span>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="outgoing_msg">
                            <div class="outgoing_msg_img">
                                <a href="<?= Url::to(['/images/administrator.png']) ?>" title="<?= $answer->answer_type ?>" class="fancybox" rel="gallery_<?= $i ?>">
                                    <img src="<?= Url::to(['/images/administrator.png']) ?>" alt="support">
                                </a>
                            </div>
                            <div class="sent_msg">
                                <p><?= nl2br($answer->message) ?></p>
                                <span class="time_date"><?= myTime('H', $answer->date) . ' | ' . myDate('ua', $answer->date) ?> | <i style="color:#000; font-style:normal;"><?= $answer->answer_type ?></i></span>
                            </div>
                        </div>
                    <?php } ?>

                <?php $i++; endforeach; ?>
                </div>
                <?php if ($question->status == 'opened') { ?>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input name="message" id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Напишіть ваше повідомлення тут..." data-toggle="tooltip" data-placement="top" title="Напишіть щось тут">
                            <span class="input-group-btn">
                                <?= Html::button('<i class="fa fa-send fa-1x" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-sm send_message_to_support', 'title' => 'Надіслати', 'onclick' => 
                                    '$.post("/admins/technical-support/view?id=' . $question->id . '&message=' . '"+$("#btn-input").val(), function(data) {
                                        $(".support_chat .msg_history").append(data);
                                        $("#btn-input").val("");
                                        $(".send_message_to_support").removeAttr("disabled").html("<i class=\'fa fa-send fa-1x\' aria-hidden=\'true\'></i>");
                                    });',
                                        // $("#count_of_answers b").html(data["count_of_answers"]);
                                ]); ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
                <?php if (count($model) >= 9) { ?>
                    <div class="scrollTopOffset"></div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
