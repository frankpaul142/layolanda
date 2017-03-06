<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use yii\web\View;
$this->title = 'Carrito de compras';
$paypalurl=Url::to(['shop/paypal']);
$script='$(document).ready(function() {
        $("#paypal").on("click", function(e){
    $("form").attr("action","../shop/paypal").submit();
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
      <div class="col-sm-2 sidebar">
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
                    
                    <li class="" parent_cat="<?= $category->id ?>" ><a class="subcategory" id="<?= $subcategory->id ?>" href="<?= Url::to(['category/subcategory','id'=>$subcategory->id]) ?>"><?= $subcategory->description ?></a></li>
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
	<div class="cont-titulos">
    	<h1>CARRITO DE COMPRAS</h1>
        <p>Revisa tu carrito de compras</p>
	</div>
    <div class="cont-formulario">
    	     <?php $form = ActiveForm::begin(['action' => ['shop/paypal'],'options' => ['method' => 'post']]); ?>
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
      $iva=0; 
      $number=Yii::$app->cart->getCost(true)*$iva;
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
      <input type="hidden" name="subtotal" value="<?= Yii::$app->cart->getCost(true) ?>" />

       	<?php if(!Yii::$app->user->isGuest): ?>
        <div id="cont-direccion">
        	<div class="direc-50">
            	<h3>Escojer datos de facturación:</h3>
                <select id="billing_id" name="billing" class="selectpicker" data-style="combo-select" >
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
                <select id="delivery_id" name="delivery" class="selectpicker" data-style="combo-select" >
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
       
        	<a id="paypal" href="#" class="btn-pago"><img class="paylogo" src="<?= URL::base() ?>/images/tarjetas.png" /></a>
               
        </div>
        	<!-- <input type="submit" value="PAGAR AHORA"/> -->
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>


<!-- -->