<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>LAYOLANDA | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <nav class="navbar navbar-default">
          <div class="container-fluid collapse navbar-collapse header-top">
            <div class="navbar-header">
              <a class="navbar-brand" href="<?= URL::base() ?>">
                <img alt="Brand" src="<?= URL::base() ?>/images/logo.png">
              </a>
            </div>
        <ul class="nav navbar-nav">
            <li><a href="#">Iniciar Sesión</a></li>
            <li><a href="#">Buscar</a></li>
        <ul>
          </div>
        </nav>
        <nav class="navbar navbar-default">
               <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
          <div class="container-fluid collapse navbar-collapse">
        <ul class="nav navbar-nav main-menu">
            <li><a href="<?= Url::to(['category/view','id'=>3]) ?>">Nueva Colección</a></li>
            <li><a href="<?= Url::to(['category/view','id'=>1]) ?>">Arte</a></li>
            <li><a href="<?= Url::to(['category/view','id'=>2]) ?>">Artesanía Fina</a></li>
            <li><a href="<?= Url::to(['artist/index']) ?>">Artista</a></li>
        <ul>
          </div>
        </nav>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
