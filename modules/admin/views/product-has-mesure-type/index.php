<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductHasMesureTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Has Mesure Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-has-mesure-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Has Mesure Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            [
             'attribute' => 'product',
             'value' => 'product.title',
             'label' =>'Producto'
             ],
            'mesure_id',
             [
             'attribute' => 'mesure',
             'value' => 'mesure.description',
             'label' =>'Medida'
             ],
             'type_id',
              [
             'attribute' => 'type',
             'value' => 'type.description',
             'label' =>'Tipo'
             ],
            'price',
            'stock',

            // 'creation_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
