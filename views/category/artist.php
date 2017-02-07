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
<div class="row container-category-product">
  <div class="">
<?= AlphaPager::widget([
    'dataProvider' => $dataProvider
]) ?>


<?php 
foreach($dataProvider->getModels() as $product) { ?>
   <div class="col-sm-4 gallery2">
        <a href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
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
