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
    // $(".change_q").change(function(){
    //     var aux2= $(this).val();
    //     var aux= $(this).attr("posid");
    //     $.get( "updatefromcart", { id: aux, quantity: aux2 } )
    //       .done(function( data ) {
    //         alert( "Data Loaded: " + data );
    //       });
        
    // });
});
';
$display="block";
$display2="block";
$number=0;
$impuesto1=0;
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
 <section  class="row">
	<div class="cont-titulos">
    	<h1>CARRITO DE COMPRAS</h1>
        <p>Revisa tu carrito de compras</p>
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

       	<?php if(!Yii::$app->user->isGuest): ?>
        <div id="cont-direccion">
        	<div class="direc-50">
            	<h3>Escojer datos de facturación:</h3>
                <select id="billing_id" name="billing">
                	<option value="" disabled>Escoge una opción</option>
                    <?php foreach(Yii::$app->user->identity->billingAddresses as $k => $billing):  ?>
                    <option value="<?= $billing->id ?>"><?= $billing->zip ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="info-faturacion">
                <?php foreach(Yii::$app->user->identity->billingAddresses as $k => $billing): ?>
                  <?php if($k!=0){ $display="none"; }  ?>
                  
                    <div class="infob-<?= $billing->id ?>" style="display:<?= $display; ?>">
                        <strong>Dirección:</strong><div id="billing_address"><?= $billing->address_line_1." ".$billing->address_line_2 ?>.</div>
                        <strong>Código Postal:</strong><div id="billing_number"><?= $billing->zip ?></div>
                        <strong>Ciudad:</strong><div id="billing_city"><?= $billing->city ?></div>
                        <strong>País:</strong><div id="billing_sector"><?= $billing->country->country_name ?></div>
                    </div>
                    
                <?php endforeach; ?>
                    <span>Si no posees direccion de Facturación. <a href="<?= Url::to(['user/address']) ?>">Ingresa aquí</a></span>
                </div>
            </div>
            <div class="direc-50">
            	<h3>Escojer la dirección de envio:</h3>
                <select id="delivery_id" name="delivery">
                    <option value="" disabled>Escoge una opción</option>
                    <?php foreach(Yii::$app->user->identity->deliveryAddresses as $k => $delivery):
                        if($k==0){
                            $address= $delivery->address_line_1." ".$delivery->address_line_2;
                            $number= $delivery->zip;
                            $city = $delivery->city;
                            $sector= $delivery->country->country_name;
                        }   
                     ?>
                    <option value="<?= $delivery->id ?>"><?= $delivery->zip ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="info-faturacion">
                <?php foreach(Yii::$app->user->identity->deliveryAddresses as $k => $delivery): ?>
                  <?php if($k!=0){ $display2="none"; }  ?>
                  
                    <div class="infod-<?= $delivery->id ?>" style="display:<?= $display2; ?>">
                        <strong>Dirección:</strong><div id="billing_address"><?= $delivery->address_line_1." ".$delivery->address_line_2 ?>.</div>
                        <strong>Código Postal:</strong><div id="billing_number"><?= $delivery->zip ?></div>
                        <strong>Ciudad:</strong><div id="billing_city"><?= $delivery->city ?></div>
                        <strong>País:</strong><div id="billing_sector"><?= $delivery->country->country_name ?></div>
                    </div>
                    
                <?php endforeach; ?>
                    <span>Si no posees direccion de Envío. <a href="<?= Url::to(['user/address']) ?>">Ingresa aquí</a></span>
                </div>
            </div>
                    <h3>Observaciones:</h3>
        <textarea name="observation" rows="4" cols="50" style="width:100%" placeholder="Cualquier explicación o requrimiento extra que necesite puede ser escrita aquí."></textarea>
        </div>
    <?php endif; ?>
		<div class="cont-fpago">
        <h1>Pagar Con:</h1>
       
        	<a id="paypal" href="#" class="btn-pago"><img class="paylogo" src="<?= URL::base() ?>/images/paypal.jpg" /></a>
            
        
               
        </div>
        	<!-- <input type="submit" value="PAGAR AHORA"/> -->
            <?php ActiveForm::end(); ?>
        </div>
    
</section>


<!-- -->