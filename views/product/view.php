<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->id;
$script=<<< JS
$('.grid').masonry({
  // options
  itemSelector: '.grid-item',
percentPosition: true,
});
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="row">
  <div class="col-sm-2 sidebar">
        <h2><?= $model->category->category->category->description ?></h2>
    <div class="sidebar-nav">
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class="nav navbar-nav">
            <?php foreach($categories as  $category): ?>
            <li ><a href="#"><?= $category->description ?></a>
                <?php if($category->categories): ?>
                <ul class="nav navbar-nav sub-category">
                    <?php foreach($category->categories as $k => $subcategory): ?>
                    <?php $selected = ($k == 0) ? 'selected' : ''; ?>
                    <li class="<?= $selected ?>" ><a href="#"><?= $subcategory->description ?></a>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
          </ul>
<!--           <ul class="nav navbar-nav politics">
                <li><a href="#">Envio</a></li>
                <li><a href="#">Contáctenos</a></li>
                <li><a href="#">¿Cómo Llegar?</a></li>
                <li><a href="#">Póliticas de Privacidad</a></li>
                <li><a href="#">Términos y Condiciones de compra</a></li>
            </ul> -->
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-10">
    <h2><?= $model->title ?></h2>
    <div class="col-sm-8 grid">
        <?php foreach($model->pictures as $k => $picture): ?>
        <?php if($k%2){ ?>
        <div class="grid-item grid-item--width2"><img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" /></div>
        <?php }else{ ?>
        <div class="grid-item"><img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" /></div>
        <?php } ?>
    <?php endforeach; ?>
    </div> 
    <div class="col-sm-4 detail">
        <div class="description-product">
        <h3>Detalles _</h3>
        <span>Autor</span>
        <p><?= $model->artist->name ?></p>
        <p><?= $model->artist->country->description ?></p>
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
                    <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" class="img-fluid" />
                <?php break; endforeach; ?>
               <a  href="<?= Url::to(['product/view','id'=>$product->id]) ?>"><?= $product->title ?></a>
            </div>
        <?php $count++; endforeach; ?>
    </div>    
  </div>
</div>