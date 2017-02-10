<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mesure */

$this->title = 'Create Mesure';
$this->params['breadcrumbs'][] = ['label' => 'Mesures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
