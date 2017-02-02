<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Direcciones';
?>
<div class="address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Dirección', ['createaddress'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'address_line_1',
            'address_line_2',
            'type',
            'city',
            'province',
            'country.country_name',
            'zip',
            'phone',
            // 'province',
            // 'country_id',
            // 'zip',
            // 'phone',
            // 'user_id',


            ['class' => 'yii\grid\ActionColumn', 'template' => '{updateaddress}',
                              'buttons'=>[
                              'updateaddress' => function ($url, $model) {     
                                return Html::a('<span alt="actualizar" class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('yii', 'Ventajas'),
                                ]);                                
            
                              }
                          ] 


            ],
        ],
    ]); ?>
</div>