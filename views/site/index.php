<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'LAYOLANDA | CONCEPT_STORE';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <?php foreach($products as $product): ?>
            <div class="col-lg-4 img-home">
                <a  href="<?= Url::to(['product/view','id'=>$product->id]) ?>">
            <?php foreach($product->pictures as $picture): ?>
                        <div class="image">
            <img src="<?= URL::base() ?>/images/products/<?= $picture->description ?>" />
            <img class="bag2" src="<?= URL::base() ?>/images/bag2.svg" />
          </div>
            <?php break; endforeach; ?>
               <?= $product->title ?>
                </a>
            </div>

            <?php endforeach; ?>
        </div>

    </div>
</div>
