<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Technique */

$this->title = 'Create Technique';
$this->params['breadcrumbs'][] = ['label' => 'Techniques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technique-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
