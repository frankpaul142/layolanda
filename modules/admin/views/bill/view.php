<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'creation_date',
            'subtotal',
            'status',
            'pay_method',
            'observation:ntext',
        ],
    ]) ?>
<div class="row">
    <div class="col-sm-4">
    <h2>Dirección de Envío</h2>
    <p><strong>Calle 1:</strong><span><?= $model->deliveryAddress->address_line_1 ?></span></p>
    <p><strong>Calle 2:</strong><span><?= $model->deliveryAddress->address_line_2 ?></span></p>
    <p><strong>Ciudad:</strong><span><?= $model->deliveryAddress->city ?></span></p>
    <p><strong>Provincia:</strong><span><?= $model->deliveryAddress->province ?></span></p>
    <p><strong>País:</strong><span><?= $model->deliveryAddress->country->country_name ?></span></p>
    <p><strong>Zip:</strong><span><?= $model->deliveryAddress->zip ?></span></p>
    <p><strong>Teléfono:</strong><span><?= $model->deliveryAddress->phone ?></span></p>
    </div>
    <div class="col-sm-4">
    <h2>Dirección de Facturación</h2>
    <p><strong>Calle 1:</strong><span><?= $model->billingAddress->address_line_1 ?></span></p>
    <p><strong>Calle 2:</strong><span><?= $model->billingAddress->address_line_2 ?></span></p>
    <p><strong>Ciudad:</strong><span><?= $model->billingAddress->city ?></span></p>
    <p><strong>Provincia:</strong><span><?= $model->billingAddress->province ?></span></p>
    <p><strong>País:</strong><span><?= $model->billingAddress->country->country_name ?></span></p>
    <p><strong>Zip:</strong><span><?= $model->billingAddress->zip ?></span></p>
    <p><strong>Teléfono:</strong><span><?= $model->billingAddress->phone ?></span></p>
    </div>
</div>
<div class="row">
<h2>Detalle de Compra:</h2>
<?php foreach($model->details as $detail): ?>
    <div class="col-sm-3">
        <p><strong>Producto:</strong><span><?= $detail->productmt->product->title ?></span></p>
        <p><strong>Medida:</strong><span><?= $detail->productmt->mesure->description ?></span></p>
        <p><strong>Tipo:</strong><span><?= $detail->productmt->type->description ?></span></p>
        <p><strong>Precio:</strong><span><?= $detail->productmt->price ?></span></p>
         <img  class="img-responsive" src="<?= URL::base() ?>/images/products/<?= $detail->productmt->product->pictures[0]->description ?>">
    </div>
<?php endforeach; ?>
</div>
</div>
