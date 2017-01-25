<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Recuperar Contraseña.';

?>
<section id="registro" class="background-registro">
    <div class="cont-titulos">
        <h1>Recupera tu contraseña.</h1>

    </div>
    <div class="cont-formulario">
            <?php $form = ActiveForm::begin([
        'id' => 'forgot-form',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "<div class=\"cont-campos f-leftc\">{label}{input}{error}</div>",
               'options' => [
                            'tag'=>'div'

                        ]
            //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
       
            <?= $form->field($model,'username')->input('email')->label('Escribe tu correo.') ?>

            
        <input type="submit" value="Recuperar"/>
           <?php ActiveForm::end(); ?>
        <div class="div-registro">
        *Te enviaremos un email para recuperar tu contraseña.
        </div>

    </div>
</section>
<!-- -->
