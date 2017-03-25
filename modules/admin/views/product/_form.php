<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;
use app\models\Artist;
use app\models\Category;
use app\models\Technique;
use app\models\Material;
use app\models\Flowing;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
 <?= $form->field($model, 'artist_id')->DropDownList(ArrayHelper::map(Artist::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),['prompt'=>'Seleccione un artista']) ?>
 <?= $form->field($model, 'category_id')->DropDownList(ArrayHelper::map(Category::find()->orderBy(['description' => SORT_ASC])->all(), 'id', 'description'),['prompt'=>'Seleccione una categoría']) ?>
<?= $form->field($model, 'technique_id')->DropDownList(ArrayHelper::map(Technique::find()->orderBy(['description' => SORT_ASC])->all(), 'id', 'description'),['prompt'=>'Seleccione una técnica']) ?>
<?= $form->field($model, 'material_id')->DropDownList(ArrayHelper::map(Material::find()->orderBy(['description' => SORT_ASC])->all(), 'id', 'description'),['prompt'=>'Seleccione un material']) ?>
<?= $form->field($model, 'flowing_id')->DropDownList(ArrayHelper::map(Material::find()->orderBy(['description' => SORT_ASC])->all(), 'id', 'description'),['prompt'=>'Seleccione una corriente']) ?>


    <?= $form->field($model, 'support')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'es',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>

    <?= $form->field($model, 'product_date')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'es',
    'dateFormat' => 'yyyy-MM-dd',
]) ?>

    <?= $form->field($model, 'important')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => '']) ?>
    <?php if(isset($pictures)){ ?>
    <?= 
FileInput::widget([
    'name' => 'pictures[]',
    'options'=>[
        'multiple'=>true
    ],
   'pluginOptions' => [
         'uploadUrl' => Url::to(['pictures-upload']),
         'deleteUrl' => Url::to(['pictures-delete']),
        'uploadExtraData' => [
            'product_id' => $model->id
        ],
        'initialPreview'=>$pictures,
        'initialPreviewAsData'=>true,
        'initialCaption'=>"Imágenes del Producto",
        'overwriteInitial'=>false,
        'maxFileSize'=>2800
    ]
]);

    ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
