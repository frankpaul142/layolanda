<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\web\View;
$this->title = 'Carrito de compras';
$script='$(document).ready(function() {
        $("#interdin").on("click", function(e){
    $("form").attr("action", "vpossend").submit();
    });
        $("#pacificard").on("click", function(e){
    $("form").attr("action", "vpossend2").submit();
    });
    $("#billing_id").change(function(){
        var id= $(this).val();
        var aux= "infob-";
        $("[class^="+aux+"]").hide();
        $(".infob-"+id).show();
    });
    $("#delivery_id").change(function(){
        var id= $(this).val();
        var aux= "infod-";
        $("[class^="+aux+"]").hide();
        $(".infod-"+id).show();
    });
    $(".change_q").change(function(){
        var aux2= $(this).val();
        var aux= $(this).attr("posid");
        $.get( "updatefromcart", { id: aux, quantity: aux2 } )
          .done(function( data ) {
            alert( "Data Loaded: " + data );
          });
        
    });
});
';
$display="block";
$display2="block";
$number=0;
$impuesto1=0;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<?php if(Yii::$app->getSession()->getFlash('warning')){ ?>
<div class="flash_message_success">
 <?= Yii::$app->getSession()->getFlash('warning'); ?>
 <div class="btn-cerrarw"><img src="<?= URL::base() ?>/images/btn-cerrarw.svg"/></div>
</div>
    <?php } ?>
 <section id="home-chaide" class="background-registro">
	<div class="cont-titulos">
    	<h1>CARRITO DE COMPRAS</h1>
        <p>Revisa tu carrito de compras</p>
        <div class="separador-p"><img src="<?= URL::base() ?>/images/separador.svg"/></div>
	</div>
    <div class="cont-formulario">
    	     <?php $form = ActiveForm::begin(['action' => 'vpossend','options' => ['method' => 'post']]); ?>
   		<div class="cont-campos-header">
        	<div class="cont-imgthumb tit-carrit">&nbsp;</div>
        	<div class="cont-txt tit-carrit">&nbsp;</div>
            <div class="cont-cant tit-carri">CANTIDAD</div>
            <div class="cont-valor tit-carri">VALOR UNITARIO</div>
             <div class="cont-valor tit-carri">VALOR</div>
        </div>
        <?php
   foreach(Yii::$app->cart->positions as $position){
          echo $this->render('_cart_item',['position'=>$position]);
          //var_dump($position);
   
        }
 ?>      
    <?php 
      $number=Yii::$app->cart->getCost(true)*0.14;
      $impuesto=number_format((float)$number, 2, '.', '');
      ?>
  		
        <div class="cont-campos-header">
        	<div class="cont-imgthumb tit-carrit">&nbsp;</div>
        	<div class="cont-txt tit-carrit">&nbsp;</div>
            <div class="cont-cant tit-carrit">&nbsp;</div>
            <div class="cont-cant c-gris">TOTAL+IVA</div>
            <div class="cont-valor c-gris">$<?= Yii::$app->cart->getCost(true)+$impuesto ?></div>
            
		</div>
        <a class="link-comprar" href="<?= Url::to(['site/index']) ?>">Seguir Comprando</a>
      <input type="hidden" name="Subtotal" value="<?= Yii::$app->cart->getCost(true) ?>" />

      <input type="hidden" name="impuesto1" value="<?= $impuesto ?>" />
      <input type="hidden" name="impuesto2" value="0" />
      <input type="hidden" name="propina" value="0" />
       <input type="hidden" name="txtReferencia1" value="0" />
       <input type="hidden" name="txtReferencia2" value="0" />
       <input type="hidden" name="txtReferencia3" value="0" />
       <input type="hidden" name="txtReferencia4" value="0" />
       <input type="hidden" name="txtReferencia5" value="0" />  
       	<?php if(!Yii::$app->user->isGuest): ?>
        <div id="cont-direccion">
        	<div class="direc-50">
            	<h1>Escojer datos de facturación:</h1>
                <select id="billing_id" name="billing">
                	<option value="" disabled>Escoge una opción</option>
                    <?php foreach(Yii::$app->user->identity->billingAddresses as $k => $billing):  ?>
                    <option value="<?= $billing->id ?>"><?= $billing->sector ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="info-faturacion">
                <?php foreach(Yii::$app->user->identity->billingAddresses as $k => $billing): ?>
                  <?php if($k!=0){ $display="none"; }  ?>
                  
                    <div class="infob-<?= $billing->id ?>" style="display:<?= $display; ?>">
                        <strong>Dirección:</strong><div id="billing_address"><?= $billing->street1." ".$billing->street2 ?>.</div>
                        <strong>No. Calle:</strong><div id="billing_number"><?= $billing->number ?></div>
                        <strong>Ciudad:</strong><div id="billing_city"><?= $billing->city->canton ?></div>
                        <strong>Sector:</strong><div id="billing_sector"><?= $billing->sector ?></div>
                    </div>
                    
                <?php endforeach; ?>
                    <span>Si no posees direccion de Facturación. <a href="<?= Url::to(['user/address']) ?>">Ingresa aquí</a></span>
                </div>
            </div>
            <div class="direc-50">
            	<h1>Escojer la dirección de envio:</h1>
                <select id="delivery_id" name="delivery">
                    <option value="" disabled>Escoge una opción</option>
                    <?php foreach(Yii::$app->user->identity->deliveryAddresses as $k => $delivery):
                        if($k==0){
                            $address= $delivery->street1." ".$delivery->street2;
                            $number= $delivery->number;
                            $city = $delivery->city->canton;
                            $sector= $delivery->sector;
                        }   
                     ?>
                    <option value="<?= $delivery->id ?>"><?= $delivery->sector ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="info-faturacion">
                <?php foreach(Yii::$app->user->identity->deliveryAddresses as $k => $delivery): ?>
                  <?php if($k!=0){ $display2="none"; }  ?>
                  
                    <div class="infod-<?= $delivery->id ?>" style="display:<?= $display2; ?>">
                        <strong>Dirección:</strong><div id="billing_address"><?= $delivery->street1." ".$delivery->street2 ?>.</div>
                        <strong>No. Calle:</strong><div id="billing_number"><?= $delivery->number ?></div>
                        <strong>Ciudad:</strong><div id="billing_city"><?= $delivery->city->canton ?></div>
                        <strong>Sector:</strong><div id="billing_sector"><?= $delivery->sector ?></div>
                    </div>
                    
                <?php endforeach; ?>
                    <span>Si no posees direccion de Envío. <a href="<?= Url::to(['user/address']) ?>">Ingresa aquí</a></span>
                </div>
            </div>
                    <h1>Observaciones:</h1>
        <textarea name="observation" rows="4" cols="50" style="width:100%" placeholder="Cualquier explicación o requrimiento extra que necesite puede ser escrita aquí."></textarea>
        </div>
    <?php endif; ?>
		<div class="cont-fpago">
        <h1>Pagar Con:</h1>
       
        	<a id="interdin" href="#" class="btn-pago"><img  src="<?= URL::base() ?>/images/pay-club.png" /></a>
            
            <a id="pacificard" href="#" class="btn-pago"><img  src="<?= URL::base() ?>/images/tarjetas-06.png" /></a>
        
               
        </div>
        	<!-- <input type="submit" value="PAGAR AHORA"/> -->
            <?php ActiveForm::end(); ?>
        </div>
    
</section>


<!-- -->