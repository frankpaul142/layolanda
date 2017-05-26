<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'creation_date',
            'username',
            'names',
            'lastnames',
            'birthday',
            'sex',
            'type',
            'password',
            'auth_key',
            'password_reset_token',
            'status',
        ],
    ]) ?>
<div class="row">
    <div class="row">
        <h2>Direcciones de Envío</h2>
    <?php foreach($model->deliveryAddresses as $deliveryAddress): ?>
        <div class="col-sm-3">
        <h3>Direcciones de Envío</h3>
        <p><strong>Calle 1:</strong><span><?= $deliveryAddress->address_line_1 ?></span></p>
        <p><strong>Calle 2:</strong><span><?= $deliveryAddress->address_line_2 ?></span></p>
        <p><strong>Ciudad:</strong><span><?= $deliveryAddress->city ?></span></p>
        <p><strong>Provincia:</strong><span><?= $deliveryAddress->province ?></span></p>
        <p><strong>País:</strong><span><?= $deliveryAddress->country->country_name ?></span></p>
        <p><strong>Zip:</strong><span><?= $deliveryAddress->zip ?></span></p>
        <p><strong>Teléfono:</strong><span><?= $deliveryAddress->phone ?></span></p>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="row">
    <h2>Direcciones de Facturación</h2>
    <?php foreach($model->billingAddresses as $billingAddress): ?>
        <div class="col-sm-3">
        <h3>Dirección de Facturación</h3>
        <p><strong>Calle 1:</strong><span><?= $billingAddress->address_line_1 ?></span></p>
        <p><strong>Calle 2:</strong><span><?= $billingAddress->address_line_2 ?></span></p>
        <p><strong>Ciudad:</strong><span><?= $billingAddress->city ?></span></p>
        <p><strong>Provincia:</strong><span><?= $billingAddress->province ?></span></p>
        <p><strong>País:</strong><span><?= $billingAddress->country->country_name ?></span></p>
        <p><strong>Zip:</strong><span><?= $billingAddress->zip ?></span></p>
        <p><strong>Teléfono:</strong><span><?= $billingAddress->phone ?></span></p>
        </div>
    <?php endforeach; ?>
    </div>
</div>
</div>
