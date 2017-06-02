<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = 'Actualizar dirección';
?>
<div class="address-create">

	<?= $this->render('../site/sidebar') ?>
    <?= $this->render('_formaddress', [
        'model' => $model,
    ]) ?>

</div>