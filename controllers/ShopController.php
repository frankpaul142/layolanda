<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use app\models\Bill;
use app\models\Detail;
class ShopController extends Controller
{
    

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['congrats','paypal'],
                'rules' => [
                    [
                        'actions' => ['congrats','paypal'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionCongrats($id)
    {
        

        $model=Bill::findOne($id);
        if(isset($_GET['PayerID'])){
                    $payerId=$_GET['PayerID'];
        $paymentId=$_GET['paymentId'];
        $apiContext = $this->getApiContext();
        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($payerId);
        $payment = new Payment();
        $payment->setId($paymentId);
        try {
            $payment = $payment->execute($paymentExecution, $apiContext);
            $model->status="PAYED";
            $model->save();
            foreach($model->details as $detail){
                $detail->stock=$detail->stock-1;
                $detail->save();
            }

        } catch (Exception $e) {
            print_r($e);die();
        }
        }
        return $this->render('congrats');
    }

    public function actionPaypal()
    {
        if(!(Yii::$app->request->post())){
            return $this->redirect(['site/cart']);
        }else{
            $aux=Yii::$app->request->post();
            if(!isset($aux['delivery']) || !isset($aux['billing'])){
                Yii::$app->getSession()->setFlash('warning','Debes crear una dirección de facturación y de entrega para continuar.');
                return $this->redirect(['site/viewcart']);  
            }
        }
        $model= New Bill;
        $model->billing_id=$aux['billing'];
        $model->subtotal=$aux['subtotal'];
        $model->delivery_id=$aux['delivery'];
        $model->creation_date=date('Y-m-d H:i:s');
        $model->status='PENDING';
        $model->pay_method='PAYPAL';
        $model->user_id=Yii::$app->user->identity->id;
        $model->observation=$aux['observation'];
         if ($model->save()) {

            foreach(Yii::$app->cart->positions as $position){
                $item=new Item();
                $item->setName($position->product->title."-".$position->mesure->description."-".$position->type->description)
                ->setCurrency('USD')
                ->setQuantity($position->quantity)
                ->setPrice($position->getPrice())
                ->setSku($position->id);
                $items[]=$item;
                $detail= New Detail;
                $detail->creation_date=date('Y-m-d H:i:s');
                $detail->product_has_mesure_type_id=$position->id;
                $detail->bill_id=$model->getPrimaryKey();
                $detail->price=$position->getPrice();
                $detail->quantity=$position->quantity;
                $detail->save();

            }
                $apiContext = $this->getApiContext();
                $payer = new Payer();
                $payer->setPaymentMethod("paypal");
                $itemList = new ItemList();
                $itemList->setItems($items);

                $details = new Details();
                $details->setSubtotal($model->subtotal);

                $amount = new Amount();
                $amount->setCurrency("USD")
                    ->setTotal($model->subtotal)
                    ->setDetails($details);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription("Payment LAYOLANDA")
                    ->setInvoiceNumber($this->generateRandomString(10));

                $baseUrl = Url::base(true);
                $redirectUrls = new RedirectUrls();
                $redirectUrls->setReturnUrl("$baseUrl/shop/congrats?id=".$model->id)
                    ->setCancelUrl("$baseUrl/site/viewcart");

                $payment = new Payment();
                $payment->setIntent("sale")
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions(array($transaction));

                try {
                    $payment->create($apiContext);
                } catch (Exception $ex) {
                    print_r($ex);
                    exit(1);
                }

                $approvalUrl = $payment->getApprovalLink();
                /* --- */
               // var_dump($items); 
                return $this->redirect($approvalUrl);
                   
        }else{
           Yii::$app->getSession()->setFlash('warning','Un error ha ocurrido, por favor intentalo mas tarde.');
           return $this->redirect(['site/viewcart']); 
        } 
    }

    private function getApiContext()
    {

        //sandbox
        $clientId = 'AatTLKio46ZF9wUTx86WbYFk3OWMuCtzS_zKXf0S8CEfh3w7y4qpQeDZycGfmZ9O0_KZCsCjPLUXVCic';
        $clientSecret = 'EB5a1uCkXOQpyDnAG8IQwM0GSxNHujeVcknVqVp93q-sJ6INOu5Xp_Pn8xgdOPHymJdkiAtcI4AmIXUI';
        //live
        // $clientId = 'ATxBN8Os9EWreT3C_YafJjxiZZAziIfwmZQKY-oh0j5dOWBEeg1q4D-vc-QcPIxgP7k8mA9RwGXQRKga';
        // $clientSecret = 'EIA-fUcMMX6BxScs9iREIUu2rYTYNzRHzJhRMZv_OwItd-pNWhXzbu6cb0cbsRvCKLHFmqtLU2cLFgbN';
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                // 'mode' => 'live',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'validation.level' => 'log',
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
            )
        );
        return $apiContext;
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    protected function Sendemail($client){
                $email=  Yii::$app->mailer->compose('transaction', [
                'model' => $client,
                ])->setFrom('info@layolanda.com')
                ->setTo(["info@layolanda.com",$client->email])
                ->setSubject("Reserva realizada #".$client->id)
                ->send();
        }

}
