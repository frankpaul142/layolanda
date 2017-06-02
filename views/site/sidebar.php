<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\web\View;
use app\models\Content;
use app\models\Category;
$content=Content::find()->orderBy(['sort' => SORT_ASC])->all();
$categories=Category::find()->where(['category_id'=>NULL])->orderBy(['sort' => SORT_ASC])->all();
$script=<<< JS
   $(".parent-category").click();
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div class="col-sm-2 sidebar affix-top">
    <h2 class="category-title"></h2>
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
                        <?php $id_link=(isset($subcategory->categories[0]->id)) ? $subcategory->categories[0]->id : null; ?>
                    <li class="" parent_cat="<?= $category->id ?>" ><a class="subcategory" id="<?= $subcategory->id ?>" href="<?= Url::to(['category/subcategory','id'=>$id_link]) ?>"><?= $subcategory->description ?></a></li>
                    <?php endforeach; ?>
                </ul>
              </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
          </ul>
          <ul class="nav navbar-nav politics collapse">
          <?php foreach($content as $cont): ?>
                <li><a href="<?= Url::to(['site/content','id'=>$cont->id]) ?>"><?= $cont->title ?></a></li>
           <?php endforeach; ?>
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