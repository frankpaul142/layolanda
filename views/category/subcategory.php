<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$script=<<< JS
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="row container-category-product">
  <div class="col-sm-3 sidebar">
    <h2><?= $model->category->category->description ?></h2>
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
            <li ><a class="category-<?= $category->id ?> parent-category" data-toggle="collapse" data-target="#sub-menu-<?= $category->id ?>" href="javascript:void(0)"><?= $category->description ?></a>
                <?php if($category->categories): ?>
                <div id="sub-menu-<?= $category->id ?>" class="collapse internal-sub-menu">
                <ul class="nav nav-sidebar sub-category">
                    <?php foreach($category->categories as $k => $subcategory): ?>
                    <?php $selected = ($subcategory->id == $model->id) ? 'selected' : ''; ?>
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
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div class="col-sm-9 container-right">
    <?php foreach($model->products as $product): ?>
   <div class="col-sm-4 gallery">
        <a href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
            <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <img class="bag2" src="<?= URL::base() ?>/images/bag2.svg" />
          </div>
        <?php break; endforeach; ?>
            <span><?= $product->title ?> <?= $product->description ?></span>
            <p>$<?= $product->minorprice['price'] ?></p>
        </a>
  </div>
  <?php endforeach; ?>           
  </div>
</div>
