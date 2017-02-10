<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductHasMesureType */

$this->title = 'Create Product Has Mesure Type';
$this->params['breadcrumbs'][] = ['label' => 'Product Has Mesure Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-has-mesure-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
