<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'names')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastnames')->textInput(['maxlength' => true]) ?>

           <?= $form->field($model, 'birthday')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'es',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions'=>[
        //'minDate' => '1900-01-01',      // minimum date
        'maxDate' => date('Y-m-d'),
        'changeMonth'=>true,
        'changeYear'=>true,
        'yearRange'=>'1900:'.date('Y'),
        ]
        ]) ?>

    <?= $form->field($model, 'sex')->dropDownList([ 'MALE' => 'MALE', 'FEMALE' => 'FEMALE', ], ['prompt' => '','class'=>'selectpicker','data-style'=>'combo-select']) ?>


    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
