<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = 'Actualizar dirección';
?>
<div class="address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formaddress', [
        'model' => $model,
    ]) ?>

</div>