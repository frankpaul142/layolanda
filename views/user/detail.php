<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Órden #'.$model->id;
?>
<div class="user-view">
 <?= $this->render('../site/sidebar') ?>
      <div class="Absolute-Center is-Responsive">
    <div id="logo-container"><h3><?= Html::encode($this->title) ?></h3></div>

    <p style="text-align: center;">
        <?= Html::a('Mi Perfil', ['user/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Direcciones', ['address'], [
            'class' => 'btn'
        ]) ?>
                <?= Html::a('Compras', ['orders'], [
            'class' => 'btn'
        ]) ?>
    </p>
<div class="row">
    <div class="card">
    <h4>Dirección de Envío</h4>
    <p><strong>Calle 1:</strong><span><?= $model->deliveryAddress->address_line_1 ?></span></p>
    <p><strong>Calle 2:</strong><span><?= $model->deliveryAddress->address_line_2 ?></span></p>
    <p><strong>Ciudad:</strong><span><?= $model->deliveryAddress->city ?></span></p>
    <p><strong>Provincia:</strong><span><?= $model->deliveryAddress->province ?></span></p>
    <p><strong>País:</strong><span><?= $model->deliveryAddress->country->country_name ?></span></p>
    <p><strong>Zip:</strong><span><?= $model->deliveryAddress->zip ?></span></p>
    <p><strong>Teléfono:</strong><span><?= $model->deliveryAddress->phone ?></span></p>
    </div>
    <div class="card">
    <h4>Dirección de Facturación</h4>
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
<h3>Detalle de Compra:</h3>
<?php foreach($model->details as $detail): ?>
    <div class="card">
        <p><strong>Producto:</strong><span><?= $detail->productmt->product->title ?></span></p>
        <p><strong>Medida:</strong><span><?= $detail->productmt->mesure->description ?></span></p>
        <p><strong>Tipo:</strong><span><?= $detail->productmt->type->description ?></span></p>
        <p><strong>Precio:</strong><span><?= $detail->productmt->price ?></span></p>
        <p><strong>Cantidad:</strong><span><?= $detail->quantity ?></span></p>
         <img  class="img-responsive" src="<?= URL::base() ?>/images/products/<?= $detail->productmt->product->pictures[0]->description ?>">
    </div>
<?php endforeach; ?>
</div>
</div>
</div>