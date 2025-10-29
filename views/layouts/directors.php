<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\{Html, Url};
use app\widgets\{Alert, Footer_questions_modal, Nav_directors, Empty_telegram, LiqPayAboveFooter};
use yii\widgets\Breadcrumbs;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= Yii::$app->getHomeUrl(); ?>images/project/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= Yii::$app->getHomeUrl(); ?>images/project/apple-touch-iphone.png">

    <?php $this->registerCssFile('@web/css/directors.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
    
    <?php $body_telegram_change_active = ''; ?>

    <?php if (Yii::$app->controller->school__payment_type == 'all') { ?>
        <?php if (Yii::$app->controller->telegram_status == 'pending' && Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time()) { ?>
            <?php $body_telegram_change_active = 'body_telegram_change_active'; ?>
        <?php } ?>

        <?php if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time())) { ?>
                <?php if (!Yii::$app->controller->telegram_id || Yii::$app->controller->telegram_status == 'pending') :
                    $this->registerCssFile('@web/css/telegram.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]); 
                endif; ?>
            <?php } ?>
    <?php } elseif (Yii::$app->controller->school__payment_type == 'single') { ?>
        <?php if (Yii::$app->controller->telegram_status == 'pending') { ?>
            <?php $body_telegram_change_active = 'body_telegram_change_active'; ?>
        <?php } ?>
        
        <?php if (!Yii::$app->controller->telegram_id || Yii::$app->controller->telegram_status == 'pending') :
            $this->registerCssFile('@web/css/telegram.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]); 
        endif; ?>
    <?php } ?>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= $body_telegram_change_active ?>">
<?php $this->beginBody() ?>

<div class="wrap">

    <?php if (Yii::$app->controller->school__payment_type == 'all') { ?>
        <?php if (Yii::$app->user->identity->school->is_test == 'yes' || (Yii::$app->controller->_payment_for_all_school && Yii::$app->controller->_payment_for_all_school['max_date'] > time())) { ?>
                <?php if (empty(Yii::$app->controller->telegram_id)) : ?>
                    <?= Empty_telegram::widget(); ?>
                <?php endif; ?>
            <?php } ?>
    <?php } elseif (Yii::$app->controller->school__payment_type == 'single') { ?>
        <?php if (empty(Yii::$app->controller->telegram_id)) : ?>
            <?= Empty_telegram::widget(); ?>
        <?php endif; ?>
    <?php } ?>

    <?= Nav_directors::widget(); ?>

    <div class="container">

        <?php if (!in_array(Yii::$app->controller->action->id, ['privacy-policy', 'refund-policy', 'public-offer'])) { ?>
            <div class="breadcrumb">
                <span class="active"><?= Yii::$app->user->identity->school->name ?> - <?= Yii::$app->user->identity->city->name ?>, <?= Yii::$app->user->identity->region->name ?></span>
            </div>
        <?php } ?>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'encodeLabels' => false,
        ]) ?>
        
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<?= LiqPayAboveFooter::widget(); ?>

<footer class="footer footer-not-main">
    <div class="container">
        <p class="pull-left copyright-not-xs" data-ip="<?= Yii::$app->getRequest()->getUserIP() ?>">&copy; School Diary 2018-<?= date('Y') ?></p>
        <span class="footer-email hidden-sm hidden-xs"><i class="fa fa-envelope" aria-hidden="true"></i> <?= Yii::$app->params['supportEmail']; ?></span>
        <div class="email-and-privacy-policy-block">
            <span class="footer-email visible-sm"><i class="fa fa-envelope" aria-hidden="true"></i> <?= Yii::$app->params['supportEmail']; ?></span>
        </div>
        <wrapper id="footer_wrapper">
            <a href="https://teleg.run/SchoolDiaryDirectors_bot" class="footer_popover" target="_blank">
                <div class="pulse">
                    <div class="wrap_block"></div>
                    <div class="telegram-bot-footer"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
                </div>
            </a>
            <span class="footer-email visible-xs"><i class="fa fa-envelope" aria-hidden="true"></i> <?= Yii::$app->params['supportEmail']; ?></span>
            <?= Footer_questions_modal::widget(); ?>
        </wrapper>
        <p class="pull-left copyright-xs" data-ip="<?= Yii::$app->getRequest()->getUserIP() ?>">&copy; School Diary 2018-<?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
