<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
  <div class="col-sm-3 sidebar">
    <h2><?= $model->description ?></h2>
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
          <ul class="nav navbar-nav politics">
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
  <div class="col-sm-9">
    <?php foreach($model->categories as $k => $category): ?>
    <?php if($k==1) break; ?>
    <?php foreach($category->categories[0]->products as $product): ?>
   <div class="col-sm-4 gallery">
        <a href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
        <?php break; endforeach; ?>
            <span><?= $product->description ?></span>
            <p>$1231</p>
        </a>
  </div>
  <?php endforeach; ?> 
  <?php endforeach; ?>           
  </div>
</div>
