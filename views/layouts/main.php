<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;
use kartik\widgets\Typeahead;
use yii\web\JsExpression;
/* @var $this \yii\web\View */
/* @var $content string */

$script=<<< JS
   $(".btn-cerrarw").click(function(){
       $(".flash_message_warning").fadeOut();
       $(".flash_message_success").fadeOut();
       });
$(document).ready(function () {
        $(".navbar-toggle").on("click", function () {
            $(this).toggleClass("active");
        });
    });
$(document).ready(function(){
  var altura = $('.main-menu').offset().top;
  
  // $(window).on('scroll', function(){
  //   if ( $(window).scrollTop() > altura ){
  //     $('.main-menu').addClass('menu-fixed');
  //   } else {
  //     $('.main-menu').removeClass('menu-fixed');
  //   }
  // });
  var isMobile = /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
  if(!isMobile) {
    $(".container-right").css('float','right');
 $("#top-menu2").sticky({topSpacing:0,responsiveWidth:true,zIndex:10});
 $('#top-menu2').on('sticky-start', function() { $('#top-menu2').addClass('sticky');$('.logosticky').css({'visibility':'visible','opacity':1}); });
 $('#top-menu2').on('sticky-end', function() { $('#top-menu2').removeClass('sticky');$('.logosticky').css({'visibility':'hidden','opacity':0}); });
$('.sidebar').affix({
  offset: {
    top: 235
  }
});
  } 
});
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=1314153345311081";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));
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
<div id="fb-root"></div>
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
                <div class=" row container-search-user">  
                  <div class="row user-nav">
                    <ul class="nav navbar-nav user-container-nav">
                        <li><a class="bag-layout" href="#"><img src="<?= URL::base() ?>/images/es.png" /></a></li>
                        <li><a class="bag-layout" href="#"><img src="<?= URL::base() ?>/images/en.png" /></a></li>
                        <li><a class="bag-layout" href="<?= Url::to(['site/viewcart']) ?>"><img src="<?= URL::base() ?>/images/bag1.png" /><span>Bolsa</span></a></li>
                         <?php if(Yii::$app->user->isGuest){ ?>
                        <li><a class="bag-layout" href="<?= Url::to(['site/login']) ?>"><img src="<?= URL::base() ?>/images/user.png" /><span>Acceso / Registro</span></a></li>
                        <?php }else{ ?>
                        <li><a class="bag-layout" style="margin-top:3px;"href="<?= Url::to(['site/logout']) ?>"><span>Cerrar Sesión</span></a></li>
                        <li><a class="bag-layout" href="<?= Url::to(['user/index']) ?>"><img src="<?= URL::base() ?>/images/user.png" /><span><?= Yii::$app->user->identity->names ?></span></a></li>
                        
                        <?php } ?>
                    
                    </ul>
                  </div>
                      <div class="search-container row">
                                <?= Typeahead::widget([
                  'name' => 'search',
                  'options' => ['placeholder' => 'search'],
                  'scrollable' => true,
                  'pluginOptions' => ['highlight'=>true],
                  'dataset' => [
                      [
                          'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                          'display' => 'value',
                           'templates' => [
                            'suggestion' => new JsExpression("Handlebars.compile('<a href=\'".URL::base()."/product/view?id={{id}}\' >{{value}}</a>')")
                          ],
                          'remote' => [
                            'url' => Url::to(['site/search2']) . '?q=%QUERY',
                            'wildcard' => '%QUERY'
                          ]
                      ]
                   ]
                ]); ?>
                <img class="img-search" src="<?= URL::base() ?>/images/lupa.png" />
              </div>
            </div>
          </div>
        </nav>
        <nav class="navbar navbar-default" role="navigation">
               <div class="navbar-header">
      <button id="button-menu2" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu2" aria-expanded="false">
        <span class="icon-bar top-bar"></span>
        <span class="icon-bar middle-bar"></span>
        <span class="icon-bar bottom-bar"></span>
      </button>
    </div>
          <div id="top-menu2" class="container-fluid collapse navbar-collapse collapse-center">
                           <a class="navbar-brand logosticky" href="<?= URL::base() ?>">
                <img alt="Brand" src="<?= URL::base() ?>/images/logosticky.png">
              </a>
        <ul class="nav navbar-nav main-menu">

            <li><a href="<?= Url::to(['category/view','id'=>3]) ?>">Nueva Colección</a></li>
            <li><a href="<?= Url::to(['category/subcategory','id'=>5]) ?>">Arte</a></li>
            <li><a href="<?= Url::to(['category/view','id'=>2]) ?>">Artesanía Fina</a></li>
            <li><a href="<?= Url::to(['category/artist']) ?>">Artista</a></li>
        </ul>
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
