<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Country;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address_line_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_line_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'BILLING' => 'BILLING', 'DELIVERY' => 'DELIVERY', 'BILLING-DELIVERY' => 'BILLING-DELIVERY', ], ['prompt' => '','class'=>'selectpicker','data-style'=>'combo-select']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_id')->DropDownList(ArrayHelper::map(Country::find()->orderBy(['country_name' => SORT_ASC])->all(), 'id', 'country_name'),['prompt'=>'Seleccione un país','class'=>'selectpicker','data-style'=>'combo-select']) ?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>