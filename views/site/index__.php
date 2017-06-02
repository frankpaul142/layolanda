<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\View;
$this->title = 'LAYOLANDA | CONCEPT_STORE';
$number_b=count($backgrounds);
$back=array();
foreach($backgrounds as $k => $background){
$back[$k]=$background->value;
}
$back=json_encode($back);
$script=<<< JS
$(document).ready(function(){       
                var scroll_start = 0;
                var startchange = $('#startchange');
                var offset = startchange.offset();
                    if (startchange.length){
                $(document).scroll(function() { 
                    scroll_start = $(this).scrollTop();
                    if(scroll_start > offset.top) {
                          $(".navbar-default").css('background-color', '#ffffff');
                       } else {
                          $('.navbar-default').css('background-color', 'transparent');
                       }
                   });
                    }
                });


JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="site-index">


    <div class="body-content">
<div id="startchange"></div>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="http://placehold.it/1200x650" alt="..." width="100%">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="http://placehold.it/1200x650" alt="..." width="100%">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="http://placehold.it/1200x650" alt="..." width="100%">
      <div class="carousel-caption">
        ...
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>

        <div class="row products-home">
        <!-- <h2>DESTACADOS</h2> -->
            <?php foreach($products as $product): ?>
            <div class="col-md-4 img-home">
                <a  href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
                        <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <!-- <img class="bag2" src="<?= URL::base() ?>/images/bag2.png" /> -->
              <div class="middle">
                <div class="hover-text"><?= $product->title ?></div>

              </div>
              <img class="bag3" src="<?= URL::base() ?>/images/bag2.png" />
          </div>
            <?php break; endforeach; ?>
               
                </a>
            </div>

            <?php endforeach; ?>
        </div>

    </div>
</div>
