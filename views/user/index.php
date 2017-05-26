<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->names." ".$model->lastnames;
?>
<div class="user-view">
      <div class="Absolute-Center is-Responsive">
    <div id="logo-container"><h3><?= Html::encode($this->title) ?></h3></div>

    <p style="text-align: center;">
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Direcciones', ['address'], [
            'class' => 'btn'
        ]) ?>
                <?= Html::a('Compras', ['orders'], [
            'class' => 'btn'
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'names',
            'lastnames',
            'birthday',
            'sex',
        ],
    ]) ?>

</div>
</div>