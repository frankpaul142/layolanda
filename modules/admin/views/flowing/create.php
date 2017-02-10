<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Flowing */

$this->title = 'Create Flowing';
$this->params['breadcrumbs'][] = ['label' => 'Flowings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flowing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
