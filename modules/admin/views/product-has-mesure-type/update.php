<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductHasMesureType */

$this->title = 'Update Product Has Mesure Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Has Mesure Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-has-mesure-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
