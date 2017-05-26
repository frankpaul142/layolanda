<?php 
use scotthuangzl\googlechart\GoogleChart;
use yii\helpers\Url;
?>
<div class="admin-default-index">
    <div class="row">
	    <div class="row">
	    		<div class="col-sm-4">
		    		<div class="panel panel-default bootcards-media" style="text-align: center;padding:2%;"> 
					  <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart" style="font-size: 20px;"></span> Total De Pedidos</div>

					  <div class="panel-body"><?= $tsells ?></div> 
					  <a href="<?= Url::to(['bill/index']) ?>" class="btn btn-primary">Ver más</a>
					</div>
	    		</div>
	    		<div class="col-sm-4">
		    		<div class="panel panel-default bootcards-media" style="text-align: center;padding:2%;"> 
					  <div class="panel-heading"><span class="glyphicon glyphicon-credit-card" style="font-size: 20px;"></span> Total De Ventas</div>

					  <div class="panel-body">$<?= $tsells2 ?></div> 
					  <a href="<?= Url::to(['bill/index']) ?>" class="btn btn-primary">Ver más</a>
					</div>
	    		</div>
	    		<div class="col-sm-4">
		    		<div class="panel panel-default bootcards-media" style="text-align: center;padding:2%;"> 
					  <div class="panel-heading"><span class="glyphicon glyphicon-user" style="font-size: 20px;"></span> Total De Usuarios</div>

					  <div class="panel-body"><?= $tusers ?></div> 
					  <a href="<?= Url::to(['user/index']) ?>" class="btn btn-primary">Ver más</a>
					</div>
	    		</div>
	    </div>
	    <div class="row">
	    <div class="col-sm-6">
	    <h2>Mapa Mundial</h2>
		<?=
		GoogleChart::widget( array(
						'visualization' => 'GeoChart',
		        		'packages'=>'geochart',//default is corechart
		                'loadVersion'=>1,//default is 1.  As for Calendar, you need change to 1.1
		                'data' => $maps,
		                'options' => array('title' => 'My Daily Activity',
		                    'showTip'=>true,
		                )));
		 ?>
	 </div>
    	<div class="col-sm-6">
	    <h2>Análisis Mensual Ventas</h2>
		<?=
GoogleChart::widget(array('visualization' => 'LineChart',
                'data' => $anas,
                'options' => array(
                    'title' => 'Análisis Mensual Ventas',
                    'titleTextStyle' => array('color' => '#FF0000'),
                    // 'vAxis' => array(
                    //     'title' => 'Ventas',
                    //     'gridlines' => array(
                    //         // 'color' => 'transparent'  //set grid line transparent
                    //     )),
                    // 'hAxis' => array('title' => 'Mes'),
                    'curveType' => 'function', //smooth curve or not
                    'legend' => array('position' => 'bottom'),
                )));
		 ?>
	 </div>
 </div>
  </div>
</div>
