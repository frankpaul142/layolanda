<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\helpers\Url;
use machour\yii2\notifications\widgets\NotificationsWidget;
/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);
//+


// // You may also use the following static methods to set the notification type:
// Notification::warning(Notification::KEY_NEW_MESSAGE, 1, 1);
// Notification::error(Notification::KEY_NO_DISK_SPACE,'KEY_NO_DISK_SPACE', 1);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= URL::base() ?>/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= URL::base() ?>/images/favicon.ico" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Contigo',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/admin/default/index']],
                    ['label' => 'Usuarios', 'url' => ['/admin/user/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);

            NavBar::end();
        ?>
        
        <div class="container" style="margin-top:8%">

            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; LAYOLANDA <?= date('Y') ?></p>
            <p class="pull-right">FAPA</p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
