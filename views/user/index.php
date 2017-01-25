<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'creation_date',
            'username',
            'names',
            'lastnames',
            'birthday',
            'sex',
            // 'type',
            // 'password',
            // 'auth_key',
            // 'password_reset_token',
        ],
    ]) ?>

</div>
