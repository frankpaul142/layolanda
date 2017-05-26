<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\web\View;
use sjaakp\alphapager\AlphaPager;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Artistas';
// $this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$script=<<< JS
var aux=$( ".selected" ).attr( "parent_cat" );
$( ".category-"+aux ).click();
JS;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<div style="text-align: center;margin-bottom: 50px;">
<?= AlphaPager::widget([
    'dataProvider' => $dataProvider
]) ?>
</div>
<div class="row container-category-product" >
  <div >



<?php 
foreach($dataProvider->getModels() as $product) { ?>
   <div class="col-sm-4 gallery2">
        <a href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
            <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <img class="bag2" src="<?= URL::base() ?>/images/bag2.svg" />
          </div>
        <?php break; endforeach; ?>
            <span><?= $product->title ?> <?= $product->description ?></span>
          </br>
            <span><?= $product->artist->name ?></span>
            <p>$<?= $product->minorprice['price'] ?></p>
        </a>
  </div>
<?php 
  }   
  ?>       
  </div>
</div>
