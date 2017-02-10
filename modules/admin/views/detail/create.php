<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Detail */

$this->title = 'Create Detail';
$this->params['breadcrumbs'][] = ['label' => 'Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
