<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Direcciones';
?>
<div class="address-index">
      <div class="Absolute-Center is-Responsive">
    <div id="logo-container"><h3><?= Html::encode($this->title) ?></h3></div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p style="text-align: center;">
        <?= Html::a('Crear Dirección', ['createaddress'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
    <?php 
foreach ($dataProvider->models as $model) { ?>
    <div class="card" style="width:100%">
  <div class="card-block">
    <h4 class="card-title"><?= $model->address_line_1 ?></h4>
    <p class="card-text"><?= $model->address_line_2 ?></p>
    <p class="card-text"><?= $model->country->country_name ?>-<?= $model->province ?>-<?= $model->city ?></p>
    <p class="card-text"><?= $model->zip ?>-<?= $model->phone ?></p>
    <p class="card-text"><?= $model->type ?></p>
    <a href="<?= Url::to(['updateaddress','id'=>$model->id]) ?>" class="btn btn-primary">Editar</a>
  </div>
</div>
    <?php
} 
?>
</div>
</div>
</div>