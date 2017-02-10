<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'artist_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'creation_date')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_date')->textInput() ?>

    <?= $form->field($model, 'technique_id')->textInput() ?>

    <?= $form->field($model, 'material_id')->textInput() ?>

    <?= $form->field($model, 'flowing_id')->textInput() ?>

    <?= $form->field($model, 'support')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'important')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => '']) ?>
    <?= 
FileInput::widget([
    'name' => 'attachment_48[]',
    'options'=>[
        'multiple'=>true
    ],
   'pluginOptions' => [
         'uploadUrl' => Url::to(['/site/file-upload']),
        'uploadExtraData' => [
            'product_id' => $model->id
        ],
        'initialPreview'=>[
            "http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
            "http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
        ],
        'initialPreviewAsData'=>true,
        'initialCaption'=>"Imágenes del Producto",
        'initialPreviewConfig' => [
            ['caption' => 'Moon.jpg', 'size' => '873727'],
            ['caption' => 'Earth.jpg', 'size' => '1287883'],
        ],
        'overwriteInitial'=>false,
        'maxFileSize'=>2800
    ]
]);

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
