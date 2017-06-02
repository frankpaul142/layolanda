<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Compras';
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
<?php foreach($model->bills as $bill): ?>
    <div class="card">
    <h4>Órden # <?= $bill->id ?></h4>
        <p>Total: $<?= $bill->subtotal ?></p>
        <p>Status: <?= $bill->status ?></p>
        <p>Método de Pago: <?= $bill->pay_method ?></p>
        <p><?= Html::a('Ver Detalles', ['detail','id'=>$bill->id], [
            'class' => 'btn'
        ]) ?></p>
    </div>
<?php endforeach; ?>
</div>
</div>
</div>