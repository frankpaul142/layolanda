<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Resetear Contraseña.';

?>
<section id="registro" class="background-registro">
    <div class="cont-titulos">
        <h1>Resetea tu contraseña.</h1>

        <div class="separador-p"><img src="<?= URL::base() ?>/images/separador.svg"/></div>
    </div>
    <div class="cont-formulario">
            <?php $form = ActiveForm::begin([
        'id' => 'reset-form',
        'options' => ['class' => ''],
        'fieldConfig' => [
            'template' => "<div class=\"cont-campos f-leftc\">{label}{input}{error}</div>",
               'options' => [
                            'tag'=>'div'

                        ]
            //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
       
            <?= $form->field($model,'password')->input('password')->label('Contraseña.') ?>
            <?= $form->field($model,'confirmpassword')->input('password')->label('Repita su contraseña.') ?>

            
        <input type="submit" value="Recuperar"/>
           <?php ActiveForm::end(); ?>
        <div class="div-registro">
        </div>

    </div>
</section>
<!-- -->
