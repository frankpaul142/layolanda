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

$script=<<< JS
   $(".btn-cerrarw").click(function(){
       $(".flash_message_warning").fadeOut();
       $(".flash_message_success").fadeOut();
       });
JS;
$this->registerJs($script,View::POS_END);
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
<?php if(Yii::$app->getSession()->getFlash('success')){ ?>
<div class="flash_message_success">
 <?= Yii::$app->getSession()->getFlash('success'); ?>
 <div class="btn-cerrarw"><img src="<?= URL::base() ?>/images/btn-cerrarw.svg"/></div>
</div>
    <?php } ?>
    <?php if(Yii::$app->getSession()->getFlash('warning')){ ?>
<div class="flash_message_warning">
 <?= Yii::$app->getSession()->getFlash('warning'); ?>
  <div class="btn-cerrarw"><img src="<?= URL::base() ?>/images/btn-cerrarw.svg"/></div>
</div>
    <?php } ?>
        <nav  id="nav-menu2"class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
             <a class="navbar-brand" href="<?= URL::base() ?>">
                <img alt="Brand" src="<?= URL::base() ?>/images/logo.png">
              </a>
    </div>
          <div id="top-menu" class="container-fluid">
            
   <!--            <a class="navbar-brand" href="<?= URL::base() ?>">
                <img alt="Brand" src="<?= URL::base() ?>/images/logo.png">
              </a> -->
           
        <ul class="nav navbar-nav">
            <li><a class="bag-layout" href="#"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></li>
            <?php if(Yii::$app->user->isGuest){ ?>
            <li><a href="<?= Url::to(['site/login']) ?>">Iniciar Sesión</a></li>
            <?php }else{ ?>
            <li><a href="<?= Url::to(['user/index']) ?>"><?= Yii::$app->user->identity->names ?></a></li>
            <li><a href="<?= Url::to(['site/logout']) ?>">Cerrar Sesión</a></li>
            <?php } ?>
            <li class="search-container">
                <input class="search-layout" type="text" placeholder="search" />
                <img class="img-search" src="<?= URL::base() ?>/images/lupa_.svg" />
            </li>
        <ul>
          </div>
        </nav>
        <nav class="navbar navbar-default" role="navigation">
               <div class="navbar-header">
      <button id="button-menu2" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu2" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
          <div id="top-menu2" class="container-fluid collapse navbar-collapse">
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
            <!-- <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p> -->
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
