<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
?>
<div class="site-login row">
        <?= $this->render('sidebar') ?>
        <div class="Absolute-Center is-Responsive">
      <div class="col-sm-12 col-md-10 col-md-offset-1">
      <div id="logo-container"><h3>Acceso</h3></div>
            <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div>{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
          
                        
            <?= $form->field($model, 'username')->textInput(['placeholder'=>'email'])->label(false) ?>          
       
            
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'password'])->label(false) ?>

  

            <div class="form-group">
               
                    <?= Html::submitButton('Login', ['class' => 'btn btn-def btn-block', 'name' => 'login-button']) ?>
                
            </div>
          <div class="form-group text-center">
                <div  style="color:#999;">
                    <p>Si no tienes cuenta por favor <a href="<?= Url::to(['register']) ?>">Regístrate</a></p>
                    <p><a href="<?= Url::to(['forgot']) ?>">¿Olvidaste tu contraseña?</a></p>
                </div>
          </div>
        <?php ActiveForm::end(); ?>      
      </div>  
    </div> 
</div>