<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Bill;
use yii\db\Query;
/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
        public function behaviors()
    {
        return [
                'access' => [
           'class' => AccessControl::className(),
           'only' => ['index'],
           'rules' => [

               [
                   'actions' => ['index'],
                   'allow' => true,
                   'roles' => ['@'],
                   'matchCallback' => function ($rule, $action) {
                       return User::isUserAdmin(Yii::$app->user->identity->username);
                   }
               ],
           ],
       ]
        ];
    }
    public function actionIndex()
    {
        $querymaps=New Query;
        $querymaps->select(["country"=>"country_name","subtotal"=>"SUM(subtotal)","bills_count"=>"COUNT(bill.id)"])->from('bill')->innerJoin('address','address.id=bill.billing_id')->innerJoin('country','country.id=address.country_id')->groupBy("country_name")->all();
        $command = $querymaps->createCommand();
        // $command->sql returns the actual SQL
        $mapsaux = $command->queryAll();
        $maps=[
        ['Country','Popularity'],
        ];
        foreach($mapsaux as $map){
          $aux1=$map['country'];
          $aux2="País: $aux1"."\nPedidos: ".$map['bills_count']."\nVentas: $".$map['subtotal'];
          $maps[]=["$aux1","$aux2"];
        }
        $queryana=New Query;
        $queryana->select(["sells"=>"SUM(subtotal)","month"=>"MONTH(creation_date)","year"=>"YEAR(creation_date)"])->from('bill')->where(['YEAR(creation_date)'=>date('Y')])->groupBy(["month"])->all();
        $command = $queryana->createCommand();
        // $command->sql returns the actual SQL
        $anaaux = $command->queryAll();
        $anas=array(
                    array('Mes','Ventas'),
                    
                );
        foreach($anaaux as $ana){
          $aux1=$ana['sells'];
          $dateObj   = \DateTime::createFromFormat('!m', $ana['month']);
          $monthName = $dateObj->format('F'); // March
          $aux2=$monthName;
          $aux3=$ana['year'];
          $anas[]=array("$aux2",(float)$aux1);
        }
        $tsells=Bill::find()->select('COUNT(id) as total')->asArray()->all();
        $tsells2=Bill::find()->select('SUM(subtotal) as total')->asArray()->all();
        $tusers=User::find()->select('COUNT(id) as total')->asArray()->all();
        return $this->render('index',['maps'=>$maps,'anas'=>$anas,'tsells'=>$tsells[0]['total'],'tsells2'=>$tsells2[0]['total'],'tusers'=>$tusers[0]['total']]);
    }
}
