<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\{Alert, LiqPayAboveFooter};
use yii\helpers\{Url, Html};
use yii\bootstrap\{NavBar, Nav};

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
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login_body">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    if (Yii::$app->user->isGuest) {

        NavBar::begin([
            'brandLabel' => 'School Diary',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

    } else {

        $controller = '';
        switch (Yii::$app->user->identity['type']) :
                    
            case 'admin'    : $controller = 'admins';    break;
            case 'teacher'  : $controller = 'teachers';  break;
            case 'student'  : $controller = 'students';  break;
            case 'parent'   : $controller = 'parents';   break;
            case 'director' : $controller = 'directors'; break;

        endswitch;
        
        NavBar::begin([
            'brandLabel' => 'School Diary',
            'brandUrl' => Url::to(['/' . $controller . ''], false),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

    }


    if (!Yii::$app->user->isGuest) {

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);

    }
    NavBar::end();
    ?>

    <div class="container">
        
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?= LiqPayAboveFooter::widget(); ?>

<footer class="footer footer-main">
    <div class="container">
        <p class="pull-left copyright-main" data-ip="<?= Yii::$app->getRequest()->getUserIP() ?>">&copy; School Diary 2018-<?= date('Y') ?></p>
        <p class="pull-right login-footer-email"><i class="fa fa-envelope" aria-hidden="true"></i> <?= Yii::$app->params['supportEmail']; ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
