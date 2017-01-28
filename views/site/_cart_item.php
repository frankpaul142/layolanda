<?php 
use yii\helpers\Url;
?>
  	<div class="cont-campos">
     
            <div class="cont-imgthumb">
            	<img src="<?= URL::base() ?>/images/products/<?= $position->product->pictures[0]->description ?>" alt="producto"/>
            </div>

            <div class="cont-txt">
            	<?= $position->product->title ?>-<?= $position->mesure->description ?>-<?= $position->type->description ?>
            </div>
            <?php if($position->id!=70000076){ ?>
            <div class="cont-cant"><input type="number"class="change_q" posid="<?= $position->id ?>" value="<?= $position->quantity ?>" /></div>
            <?php }else{ ?>
            <div class="cont-cant">-</div>
            <?php } ?>
            <div class="cont-valor">
              <span class="precio-normal">PRECIO NORMAL:</span>
              <span class="valores-p">$<?= $position->price ?></span>
              <span class="valores-p c-blue">$<?= $position->getPrice() ?></span>
            </div>
                <div class="cont-valor">$<?= $position->getPrice()*$position->quantity ?></div>
            
             
    </div>