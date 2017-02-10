<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'artist_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'creation_date') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'product_date') ?>

    <?php // echo $form->field($model, 'technique_id') ?>

    <?php // echo $form->field($model, 'material_id') ?>

    <?php // echo $form->field($model, 'flowing_id') ?>

    <?php // echo $form->field($model, 'support') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'important') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
