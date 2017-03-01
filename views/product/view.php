<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$id=$model->id;
$script=<<< JS
  var freeMasonry = $('.grid');
  freeMasonry.imagesLoaded()
    .done(function(){
      freeMasonry.masonry({
          itemSelector: '.grid-item',
percentPosition: true,
      });
    });
   $("#type").change(function(){
        $("#mesure option").hide();
        var product_id=$id;
        var type=$(this).val();
        $('#mesure option[value=""]').show();
        $('#mesure option:eq(0)').prop('selected', true);
         $.ajax( {
              type: "POST",
              url: "consult-mesures",
              data: {product_id:product_id,type:type},
              dataType:'json',
              success: function( data ) {
                console.log(data);
                
              $.map(data, function( val, i ) {
                        $('#mesure').append('<option value="'+val.id+'" price="'+val.price+'">'+val.description+'</option>');
                    });
                    $('#mesure option:eq(0)').prop('selected', true);
                    $('#mesure').selectpicker('refresh');
                }

        });
    });
$("#mesure").change(function(){
        $(".price-product").hide();
        var id=$(this).val();
        $("#mtype-"+id).show();

      });
// $( document ).ready(function() {
// $('.grid').masonry({
//   // options
//   itemSelector: '.grid-item',
// percentPosition: true,
// });
// });
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="row container-category-product">
  <div class="col-sm-2 sidebar">
    <h2 class="category-title"><?= $model->category->category->category->description ?></h2>
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button  type="button" class="navbar-toggle button-menu3" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
        <span class="icon-bar top-bar"></span>
        <span class="icon-bar middle-bar"></span>
        <span class="icon-bar bottom-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse vertical-menu">
          <ul class="nav navbar-nav">
            <?php foreach($categories as  $category): ?>
            <li >
              <a class="category-<?= $category->id ?> parent-category" data-toggle="collapse" data-target="#sub-menu-<?= $category->id ?>" href="javascript:void(0)"><?= $category->description ?></a>
                <?php if($category->categories): ?>
                <div id="sub-menu-<?= $category->id ?>" class="collapse internal-sub-menu">
                <ul class="nav nav-sidebar sub-category">
                    <?php foreach($category->categories as $k => $subcategory): ?>
                    <?php $selected = ($subcategory->id == $model->category_id) ? 'selected' : ''; ?>
                    <li class="<?= $selected ?>" parent_cat="<?= $category->id ?>" ><a class="subcategory" id="<?= $subcategory->id ?>" href="<?= Url::to(['category/subcategory','id'=>$subcategory->id]) ?>"><?= $subcategory->description ?></a></li>
                   <?php endforeach; ?>
                </ul>
                </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
          </ul>
          <ul class="nav navbar-nav politics collapse">
                <li><a href="#">Envio</a></li>
                <li><a href="#">Contáctenos</a></li>
                <li><a href="#">¿Cómo Llegar?</a></li>
                <li><a href="#">Póliticas de Privacidad</a></li>
                <li><a href="#">Términos y Condiciones de compra</a></li>
          </ul>
          <ul class="nav social collapse">
                <li><a href="#"><img src="<?= URL::base() ?>/images/facebook.png" /></a></li>
                <li><a href="#"><img src="<?= URL::base() ?>/images/twitter.png" /></a></li>
                <!-- <li><a href="#"><img src="<?= URL::base() ?>/images/instagram.svg" /></a></li> -->
                <li><a href="#"><img src="<?= URL::base() ?>/images/pinterest.png" /></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-10 container-right">
    <h2><?= $model->title ?></h2>
    <div class="col-sm-8 grid">
        <?php foreach($model->pictures as $k => $picture): ?>
        <?php if($k%2){ ?>
        <div class="grid-item grid-item--width2">
          <a href="<?= URL::base() ?>/images/products/<?= $picture->description ?>" data-toggle="lightbox" data-gallery="example-gallery"><img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" /></a>
        </div>
        <?php }else{ ?>
        <div class="grid-item">
          <a href="<?= URL::base() ?>/images/products/<?= $picture->description ?>" data-toggle="lightbox" data-gallery="example-gallery"><img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" /></a>
          </div>
        <?php } ?>
    <?php endforeach; ?>
    </div> 
    <div class="col-sm-4 detail">
        <div class="description-product">
        <h3>Detalles _</h3>
        <span>Autor</span>
        <p><?= $model->artist->name ?></p>
        <p><?= $model->artist->country->country_name ?></p>
        <p><?= date('Y',strtotime($model->artist->birthday)) ?><?php if($model->artist->death_date) echo "-".date('Y',strtotime($model->artist->death_date)); ?> </p>
        <span>Técnica</span>
        <p><?= $model->technique->description ?></p>
        <span>Materiales</span>
        <p><?= $model->material->description ?></p>
        <span>Corriente</span>
        <p><?= $model->flowing->description ?></p>
        <span>Soporte</span>
        <p><?= $model->support ?></p>
    </div>
    <span>Láminas</span>
    <p>Papel y acabado / Tamaño / Marco</p>
    <select id="type" class="selectpicker" data-style="combo-select" title="Escoge un tipo" data-width="80%" >
        <?php foreach($model->types as $type): ?>
        <option value="<?= $type->id ?>"><?= $type->description ?></option>
    <?php endforeach; ?>
    </select>
    <select id="mesure" class="selectpicker" data-style="combo-select" title="Escoge una medida" data-width="80%" >
    </select>
    <ul class="notes">
            <li>
            Papel estandar sin enmarcar
            </li>
            <li>
              Papel fotográfico RC de alta resolución,
              mínimo de 240 gr / m2 acabado brillo.
          </li>
            <li>
              Margen sin imprimir de 5 cm. Por lado que
              se añaden al tamaño de la lámina.
            </li>
            <li>
              Te llegará en 7 / 15 días enrollada en un tubo
              rígido.
            </li>
    </ul>
            <a href="https://www.pinterest.com/pin/create/button/">
            <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" />
        </a>
        <div class="fb-share-button" data-href="<?= Url::current(); ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Compartir</a></div>
    <a class="twitter-share-button"
  href="https://twitter.com/intent/tweet?text=<?= $model->title ?>">
Tweet</a>
    <?php foreach($model->mesuretypes as $mtypes): ?>
    <span id="mtype-<?= $mtypes->id ?>" class="price-product">$<?= $mtypes->price ?><a href="<?= Url::to(['site/addtocart','id'=>$mtypes->id]) ?>"><img src="<?= URL::base() ?>/images/bag1.svg" /></a></p>
    <?php endforeach; ?>
    </div>
    <div class="row more-products">
        <h3>Otras Obras _</h3>
        <?php $count=0; foreach($model->artist->products as $product):  ?>
                        <?php if($product->id==$model->id){
                   continue; 
                }else{
                    if($count>2){
                        break;
                    }
                } ?>
            <div class="col-sm-4 img-home">
                <?php foreach($product->pictures as $picture): ?>
                  <div class="image">
                    <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" class="img-fluid" />
                    <img class="bag2" src="<?= URL::base() ?>/images/bag2.svg" />
                  </div>
                <?php break; endforeach; ?>
               <a  href="<?= Url::to(['product/view','id'=>$product->id]) ?>"><?= $product->title ?></a>
            </div>
        <?php $count++; endforeach; ?>
    </div>    
  </div>
</div>