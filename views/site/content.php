<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = $model->title;

?>
<div class="site-index">


    <div class="body-content">
    	 <h1><?= Html::encode($this->title) ?></h1>
        <div class="row">
        <?= $model->description ?>
        </div>

    </div>
</div>
