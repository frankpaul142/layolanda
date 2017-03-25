<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

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
            'title',
            'artist.name',
            'category.description',
            'creation_date',
            'description',
            'product_date',
            'technique.description',
            'material.description',
            'flowing.description',
            'support',
            'important',
        ],
    ]) ?>
    <div class="row">
    <?php foreach($model->pictures as $picture): ?>
        <div class=col-sm-3>
            <img  class="img-responsive" src="<?= URL::base() ?>/images/products/<?= $picture->description ?>">
        </div>
    <?php endforeach; ?>
    </div>
</div>
