<?php
use yii\helpers\Url;
use app\models\DinersTransaction;
if($model->type=="INTERDIN"){
$dn=DinersTransaction::find()->where(['orden'=>$model->transactionid])->one();
}
 ?>
<style>
h1{
        color:#414042;
        font-family:Verdana, Geneva, sans-serif;
        font-size:12;
    }
    h3{
        color:#414042;
        font-family:Verdana, Geneva, sans-serif;
        font-size:16px;
        text-align:center;
        padding:0;
        margin:0;
    }
    p {
        text-align:center;
        color:#414042;
        font-family:Verdana, Geneva, sans-serif;
        font-size:14px;
        padding:0;
        margin:0;
    }
    
    #divlogo{
        display:block;
        padding:30px 0 50px 20px;
        height:50px;
        width:100%;
        float:left;
    }
    
    #divlogo section{
        display: block; 
        float: left;
    }
    .divlogo2{
        width:48%;
        text-align:right;
        float:left;
    }
    
    #divpedido{
        width:50%;
        text-align:right;
        float:right;
    }
    
    #divpedidonum{
        text-align:right;
        width:45%;
        float:left;
    }
    
    input {
        border: none;
    }
    
    .clase_formulario{
        font-family:Verdana, Geneva, sans-serif;
        font-size:16px;
        color:#414042;
        padding: 5px 0 0 0;
        margin: 0 0 0 10px;
        width:100%;
        float:left;
    }
    
    .clase_formulario2{
        font-family:Verdana, Geneva, sans-serif;
        font-size:16px;
        color:#414042;
        padding:0;
        margin: 0;  
    }
    
    .clase_formulario3{
        font-family:Verdana, Geneva, sans-serif;
        font-size:12px;
        color:#414042;
        padding:0 0 0 10px;
        margin: 0;
        text-align:center;
        width:100%;
        float:left;
    }
    
    .clase_formulario4{
        font-family:Verdana, Geneva, sans-serif;
        font-size:16px;
        color:#414042;
        padding:10px 20px 10px 10px;
        margin: 0;
        text-align:right;
    }
    
    #divcontent {
        overflow: auto; 
        padding: 15px;
        padding-bottom:20px;
        width:100%;
        float:left;
    }
    
    #divcontent section {
        display: block; 
        float: left;
    }
    
    #divfecha {
        padding:0;
        margin:5px 0 0 15px;
        background-color:#DADADA;
        height:35px;
        width:874px;
        float:left;
    }
    
    #divpago{
        overflow: auto; 
        padding: 2px 0  0 15px;
        width:100%;
        float:left;
    }
    
    #divpago section{
        float: left; 
        width: 31.3%;   
        background-color:#E7E7E7;
        margin-right:1%;
        padding:5px 1% 30px 1%;
    }
    
    #principal{
        width:960px;    
    }
    
    #section_datos{
        width:48%;
        padding:0 1%;
    }
    
    #divdescripcion{
        padding:0 0 0 15px;
        margin:5px 0 0 0;
        height:200px;
        background-image:url("http://shareecuador.com/chaide/separador.jpg");
        background-repeat: repeat-y;
        width:100%;
        float:left;
    }
    
    #divdescripcion_int{
        float: left;
        padding:0;
        margin:0;
    }
    #divdescripcion_int img{
        width:100%;
        }
    #divtotal{
        text-align:right;
        width:874px;
        padding:10px 3% 0 3%;
        float:left;
        width:94%;
    }
    
    #divpie{
        padding:5px 0 0 0;
        margin:50px 0 0 15px;
        background-color:#DADADA;
        height:50px;
        width:874px;    
    }
    
    #divpagina{
        padding:5px 0 0 0;
        margin:80px 0 0 15px;
        width:874px;    
    }
    .labelform{ 
        border:1px solid #FFFFFF;
        text-align:left;
        padding:1px 0 0 0;
        margin:0;
        float:left;
        font-weight:bold;
    }
    .labelformgrupo{    
        text-align:left;
        padding:4px 0 0 10px;
        margin:0;
        width:100%;
        float:left;
    }
    .datos-izq{
        width:70%;
        }
    .campos-100{
        width:100%;
        float:left;
        margin:2px 0;
        }   
    .campos-100 label{
        float:left;
        }   
    article{
        display:block;  
        float:left;
    }
    #dato1{
        width:38.5% !important;
        float:left;
        }
    #dato2, #dato3, #dato5{
        width:14% !important;
        float:left;
        }
    #dato4, #dato6 {
        width:8.9% !important;
        float:left;
        }

</style>
    <table width="700" border="0" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td style="color:#4a4a49; font-size:20px; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align:center; font-weight:300; padding:10px 0 0 0;">
                    - Estimad@ - <br/>
                   <font style="color:#006ab0; font-size:60px; font-weight:700;"><?= $name ?></font> <br/>
                    Su compra fue realizada exitosamente.  

          </td>
        </tr>
        <tr>
          <td><a href="#" target="_blank"><img src="http://shareecuador.com/mailing/chaide/compra-ex.jpg" width="700" style="display:block" alt=""/></a></td>
        </tr>
        <tr>
        	<td>
        	<table width="100%">
                <tr>
                    <td width="350px" style="color:#FFF; font-size:20px; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align:center; font-weight:100; background-color:#006ab0; text-align:center; padding:10px 0;">
                    	El ID es:<br/>
                        <font style="font-size:35px; font-weight:bold;"><?= $model->sap_id."" ?></font><br>

                    </td>
                    <td width="350px" style="color:#FFF; background-color:#006ab0; font-size:20px; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; text-align:center; font-weight:100; text-align:center; padding:10px 0;">
                    	El monto debitado fue de:<br/>
                        <font style="font-size:35px; font-weight:bold;">$<?= $total ?></font>
                    </td>
                </tr>
            </table>
            </td>
        </tr>
        <tr>
          <td><a href="#" target="_blank"><img src="http://shareecuador.com/mailing/chaide/chaide-ex2.jpg" width="700" style="display:block" alt=""/></a></td>
        </tr>
        <tr >
            <td style="background-color:#FFFF; text-align:center; font-size:12px; color:#FFF; padding:0 0 15px 0; color:#006ab0;"><a href="http://www.chaide.com/" target="_blank" style="color:inherit; text-decoration:none;">www.chaide.com</a> - <a href="https://www.facebook.com/ChaideOficial" target="_blank" style="color:inherit; text-decoration:none;">www.facebook.com/ChaideOficial</a></td>
        </tr>
      </tbody>
    </table>
     <div id="divcontent">
        <section id="section_datos">
            <img src="http://shareecuador.com/chaide/datos_entrega.png" width="418" height="27"/>
                <article class="labelformgrupo">
                    <form action="demo_form.asp" method="get" class="clase_formulario">
                    <div class="campos-100"><span class="labelform">Nombre: </span><label for="male"><?= $model->user->names." ".$model->user->lastnames ?></label></div>
                    <div class="campos-100"><span class="labelform">Cédula: </span><label for="male"><?= $model->user->identity ?></label></div>
                    <div class="campos-100"><span class="labelform">Dirección: </span><label for="male"><?= $model->delivery->street1."-".$model->delivery->street2."-".$model->delivery->sector ?></label></div>
                    <div class="campos-100"><span class="labelform">Ciudad: </span><label for="male"><?= $model->delivery->city->canton ?></label></div>
                    <div class="campos-100"><span class="labelform">Teléfono: </span><label for="male"><?= $model->user->phone ?></label></div>
                    <div class="campos-100"><span class="labelform">Celular: </span> <label for="male"><?= $model->user->cellphone ?></label></div>                     
                    </form>
                </article>
            </section>
            <section id="section_datos">
                <img src="http://shareecuador.com/chaide/datos_facturacion.png" width="418" height="27"/>
                <article class="labelformgrupo">
                    <form action="demo_form.asp" method="get" class="clase_formulario">
                    <div class="campos-100"><span class="labelform">Nombre: </span><label for="male"><?= $model->user->names." ".$model->user->lastnames ?></label></div>
                    <div class="campos-100"><span class="labelform">Cédula: </span><label for="male"><?= $model->user->identity ?></label></div>
                    <div class="campos-100"><span class="labelform">Dirección: </span><label for="male"><?= $model->billing->street1."-".$model->billing->street2."-".$model->billing->sector ?></label></div>
                    <div class="campos-100"><span class="labelform">Ciudad: </span><label for="male"><?= $model->billing->city->canton ?></label></div>
                    <div class="campos-100"><span class="labelform">Teléfono: </span><label for="male"><?= $model->user->phone ?></label></div>
                    <div class="campos-100"><span class="labelform">Celular: </span> <label for="male"><?= $model->user->cellphone ?></label></div> 
                    </form>
                </article>
        </section>
    </div>
    <div id="divfecha"> 
        <form action="demo_form.asp" method="get" class="clase_formulario">
              <label for="male"><?= $model->creation_date ?></label><br>
        </form>
    </div>
    <div id="divpago">
        <section>
            <form action="demo_form.asp" method="get" class="clase_formulario2">
                Pago Total: <br><label for="male"><?= $model->total ?></label><br>
            </form>
        </section>
        <?php if($model->type=="INTERDIN"){ ?>
        <section>
            <form action="demo_form.asp" method="get" class="clase_formulario2">
                 Meses Plazo: <br><label for="male"><?= $dn->meses ?></label><br>
            </form>
        </section>
        <section>
            <form action="demo_form.asp" method="get" class="clase_formulario2">
                Modo de Pago: <br><label for="male"><?= $dn->credito ?></label><br>
            </form>
        </section>
        <?php } ?>
    </div>
    <div id="divdescripcion">
    	<table width="100%" cellpadding="1" cellspacing="1">
            <tr>
                <td><img src="http://shareecuador.com/chaide/images/pdf/descripcion.jpg" width="100%"/></td>
                <td><img src="http://shareecuador.com/chaide/images/pdf/referencia.jpg" width="100%" /></td>
                <td><img src="http://shareecuador.com/chaide/images/pdf/precio.jpg" width="100%"/></td>
                <td><img src="http://shareecuador.com/chaide/images/pdf/cantidad.jpg" width="100%"/></td>
                <td><img src="http://shareecuador.com/chaide/images/pdf/totalsiniva.jpg" width="100%" /></td>
                <td><img src="http://shareecuador.com/chaide/images/pdf/total.jpg" width="100%"/></td>
        	</tr>
             <?php foreach($model->details as $detail): ?>
            <tr>
                <td>
                	<form action="demo_form.asp" method="get" class="clase_formulario3">
                    	<label for="male"><?= $detail->product->title ?><?= $detail->sapCode->mesure->description ?></label>
                	</form>
                </td>
                <td>
                	<form action="demo_form.asp" method="get" class="clase_formulario3">
                    	<label for="male"><?= $detail->sap_id ?></label>
                	</form>
                </td>
                <td>
                	<form action="demo_form.asp" method="get" class="clase_formulario3">
                    	<label for="male"><?= $detail->sapCode->price ?></label>
                	</form>
                </td>
                <td>
                	<form action="demo_form.asp" method="get" class="clase_formulario3">
                    	<label for="male"><?= $detail->quantity ?></label>
               		</form>
                </td>
                <td>
                	<form action="demo_form.asp" method="get" class="clase_formulario3">
                    	<label for="male"><?= $detail->sapCode->price*$detail->quantity  ?></label>
               		</form>
                </td>
                <td>
                	<form action="demo_form.asp" method="get" class="clase_formulario3">
                   		<?php $number=$detail->price*1.12; ?>
                    	<label for="male"><?= number_format((float)$number, 2, '.', '') ?></label>
                	</form>
                </td>
        	</tr>
            <?php endforeach; ?>
        </table>
        <!--<div class="campos-100">
            <section id="divdescripcion_int" id="dato1">
                <img src="http://shareecuador.com/chaide/descripcion.jpg" width="100%"/>
                
            </section>
            <section id="divdescripcion_int" id="dato2">
                <img src="http://shareecuador.com/chaide/referencia.jpg" width="100%" />
                
            </section>
            <section id="divdescripcion_int" id="dato3">
                <img src="http://shareecuador.com/chaide/precio.jpg" width="100%"/>
                
            </section>
            <section id="divdescripcion_int" id="dato4">
                <img src="http://shareecuador.com/chaide/cantidad.jpg" width="100%"/>
                
            </section>
            <section id="divdescripcion_int" id="dato5">
                <img src="http://shareecuador.com/chaide/totalsiniva.jpg" width="100%" />
                
            </section>
            <section id="divdescripcion_int" id="dato6">
                <img src="http://shareecuador.com/chaide/total.jpg" width="100%"/>
                
            </section>
        </div>
        <?php foreach($model->details as $detail): ?>
        <div class="campos-100">
            <section id="divdescripcion_int" id="dato1">
                <form action="demo_form.asp" method="get" class="clase_formulario3">
                    <label for="male"><?= $detail->product->title ?><?= $detail->sapCode->mesure->description ?></label>
                </form>
            </section>
            <section id="divdescripcion_int" id="dato2">
                <form action="demo_form.asp" method="get" class="clase_formulario3">
                    <label for="male"><?= $detail->sap_id ?></label>
                </form>
            </section>
            <section id="divdescripcion_int" id="dato3">
                <form action="demo_form.asp" method="get" class="clase_formulario3">
                    <label for="male"><?= $detail->sapCode->price ?></label>
                </form>
            </section>
            <section id="divdescripcion_int" id="dato4">
                <form action="demo_form.asp" method="get" class="clase_formulario3">
                    <label for="male"><?= $detail->quantity ?></label>
                </form>
            </section>
            <section id="divdescripcion_int" id="dato5">
                <form action="demo_form.asp" method="get" class="clase_formulario3">
                    <label for="male"><?= $detail->sapCode->price*$detail->quantity  ?></label>
                </form>
            </section>
            <section id="divdescripcion_int" id="dato6">
                <form action="demo_form.asp" method="get" class="clase_formulario3">
                    <?php $number=$detail->price*1.12; ?>
                    <label for="male"><?= number_format((float)$number, 2, '.', '') ?></label>
                </form>
            </section>
        </div>
        <?php endforeach; ?>-->
    </div>
<!--     <div id="divfecha">
        <form action="demo_form.asp" method="get" class="clase_formulario">
            MANEJO DE PRODUCTO-Costos Adicionales: <label for="male">manejo...</label><br>
        </form>
    </div> -->
    <div id="divtotal">
        <form action="demo_form.asp" method="get" class="clase_formulario2">
            Total productos (tax excl.): <label for="male">
            <?php $totalnoiva=$model->total/1.12 ?>
            <?= number_format((float)$totalnoiva, 2, '.', '') ?>
        </label><br>
            Total IVA incluído: <label for="male"><?= $model->total ?></label><br>
        </form>
    </div>
    
    <div id="divpie">
        <p>Este documento no reemplaza la factura comercial, la misma será enviada con el producto.</p>
        <h3>¡Gracias por su compra!</h3>
    </div>
    
    <div id="divpagina">
        <img src="http://shareecuador.com/chaide/separador2.jpg" width="872" height="3" />
        <form action="demo_form.asp" method="get" class="clase_formulario4">
            P. <label for="male">1 / 1</label><br>
        </form>
        <p>La versión electrónica de este comprobante está disponible en su cuenta. Para acceder a ella, identifíquese en</p>
        <p>Chaide nuestra Web usando su dirección de correo electrónico y contraseña (que creó cuando realizó su primer pedido).</p><br />
        <img src="http://shareecuador.com/chaide/chaidegris.jpg" width="872" height="46" />
    </div>