<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\View;
use yii\widgets\ActiveForm;
use sjaakp\alphapager\AlphaPager;
use yii\data\Sort;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Type;
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->description;
$findUrl = 'category/subcategory?id='.$model->id;
$sort->route = $findUrl;
// $this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$script=<<< JS
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
$(".filter-title").click(function(){
  if($( ".arrow-down" ).length){
   $(".arrow-down").addClass('arrow-up');
  $(".arrow-up").removeClass('arrow-down');
  }else{
       $(".arrow-up").addClass('arrow-down');
  $(".arrow-down").removeClass('arrow-up');
  }

    $(".links-filters").toggle(700);
});
if ( $( ".asc" ).length ) {
    
  $(".arrow-down").addClass('arrow-up');
  $(".arrow-up").removeClass('arrow-down');
    $(".links-filters").toggle(700);
 
}
if ( $( ".desc" ).length ) {
     $(".arrow-down").addClass('arrow-up');
  $(".arrow-up").removeClass('arrow-down');
    $(".links-filters").toggle(700);
 
}
$( "#search" ).click(function() {
  $( "#search-product" ).submit();
});
// $('body').on('click', function(event) {
//   var target = $(event.target);
//   if (target.parents('.bootstrap-select').length) {
//         console.log("sop");
//     event.stopPropagation();
//     $('.bootstrap-select').toggleClass('open');
//   }
// }); 
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="row container-category-product">
  <div class="col-sm-2 sidebar">
    <h2 class="category-title"><?= $model->category->category->description ?></h2>
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
  <div class="col-sm-10 container-right">
    <div class="row filters">
      <div class="row"><a class="filter-title" href="javascript:void(0)"><div class="box"><div class="arrow-down"></div></div>Filtrar Y Ordenar</a></div>
<!--       <div class="row links-filters"><?= $sort->link('title',['class'=>'sorter']) ?></div> -->
      <?php
  $form = ActiveForm::begin([ 'id'=>'search-product',
        'method' => 'get',
    ]);
 ?>
<!-- <div class="col-md-2 links-filters">
              <div class="btn-group">
                <button type="button" class="btn btn-large dropdown-toggle combo-select"  data-toggle="dropdown">
                    Desde <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <form class="form col-sm-12"> 
                      <div class="form-group">
                       <?=$form->field($searchModel,'price1'); ?>
                      </div>
                    </form>
                  </li>
                  <li>
                    <form class="form col-sm-12">    
                      <select class="selectpicker" data-style="combo-select">
                        <option>0-100</option>
                        <option>100-200</option>
                        <option>200-300</option>
                      </select>
                    </form>
                  </li>
                </ul>
            </div></div>
<div class="col-md-2 links-filters">
              <div class="btn-group">
                <button type="button" class="btn btn-large dropdown-toggle" data-toggle="dropdown">
                    Hasta <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <form class="form col-sm-12"> 
                      <div class="form-group">
                       <?=$form->field($searchModel,'price2'); ?>
                      </div>
                    </form>
                  </li>
                  <li>
                    <form class="form col-sm-12">    
                      <select class="selectpicker" data-style="combo-select" multiple="">
                        <option>0-100</option>
                        <option>100-200</option>
                        <option>200-300</option>
                      </select>
                    </form>
                  </li>
                </ul>
            </div></div> -->
    <div class="col-md-2 links-filters"><?=$form->field($searchModel,'price1'); ?></div>
    <div class="col-md-2 links-filters"><?=$form->field($searchModel,'price2'); ?></div>
    <div class="col-md-2 links-filters"><?= $form->field($searchModel, 'type')->DropDownList(ArrayHelper::map(type::find()->orderBy(['description' => SORT_DESC])->all(), 'id', 'title'),['title'=>'Tipo','data-style'=>'combo-select','class'=>'selectpicker','data-width'=>'100%']) ?></div> 
    <div class="col-md-2 links-filters"><?= $form->field($searchModel, 'size')->DropDownList([''=>'Todos','S'=>'Pequeño','M'=>'Mediano','L'=>'Grande'],['title'=>'Tamaño','data-style'=>'combo-select','class'=>'selectpicker','data-width'=>'100%']) ?></div> 
    <div class="col-md-2 links-filters"><p>&nbsp;</p><a id="search" href="javascript:void(0)"><img class="img-search" src="<?= URL::base() ?>/images/lupa.png" />&nbsp;Buscar</a></div>
<?php 
ActiveForm::end();
?>
    </div>
    <?php foreach($dataProvider->getModels() as $product): ?>
   <div class="col-sm-3 gallery">
        <a href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
            <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <img class="bag2" src="<?= URL::base() ?>/images/bag2.png" />
          </div>
        <?php break; endforeach; ?>
            <span><?= $product->title ?> (<?= date('Y',strtotime($product->product_date)) ?>)<br><?= $product->artist->name ?></span>
            <p>desde $<?= $product->minorprice['price'] ?></p>
        </a>
  </div>
  <?php endforeach; ?>           
  </div>
</div>
