<?php
use yii\helpers\Html;
// use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Felicidades '.$model->names;

?>
<section id="home" class="background-registro">

	<div class="cont-titulos">
    	<h1>REGISTRO</h1>
      
	</div>
    <div class="cont-formulario">
   		    <div class="cont-infocamposf2 conf-compra">
            	GRACIAS POR REGISTRARTE<br/>
                <span> <?= strtoupper($model->names) ?> </span><br/>
                <font>Hemos enviado un correo electrónico para que puedas activar tu cuenta</font>
                <?= Yii::$app->getSession()->getFlash('success'); ?>
	     		<?= Yii::$app->getSession()->getFlash('warning'); ?>
            </div> 

    </div>
</section>