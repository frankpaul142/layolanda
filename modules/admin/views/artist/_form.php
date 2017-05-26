<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Country;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Artist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'country_id')->DropDownList(ArrayHelper::map(Country::find()->orderBy(['country_name' => SORT_ASC])->all(), 'id', 'country_name'),['prompt'=>'Seleccione un país']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
