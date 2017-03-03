<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ForgotForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Product;
use app\models\Category;
use app\models\ProductHasMesureType;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $products=Product::find()->where(['important'=>'YES'])->limit(3)->all();
        return $this->render('index',['products'=>$products]);
    }

    public function actionSearch2($q = null) {
        $products=Product::find()->where(['LIKE','title',$q])->orderBy('title')->all();
        $out=array();
        foreach ($products as $product) {
         // $out[] = Html::a($product->description, ['product/view', 'id' => $product->id], []);
         $out[] = ['value' => $product->title,'id'=>$product->id];
    }
        return Json::encode($out);
}
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionAddtocart($id){
            $cart = Yii::$app->cart;
            $model = ProductHasMesureType::find()->where(['id'=>$id])->one();
            if ($model) {
                $cart->put($model, 1);
                //die(print_r($cart));
                return $this->redirect(['viewcart']);
            }
            Yii::$app->getSession()->setFlash('warning','Por favor escoja una medida.');
            return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionRemovefromcart($id){
            $cart = Yii::$app->cart;
            $model = ProductHasMesureType::find()->where(['id'=>$id])->one();
            if ($model){
                $cart->remove($model);
                //die(print_r($cart));
                return $this->redirect(['viewcart']);
            }
        throw new NotFoundHttpException();

    }
    public function actionUpdatefromcart($id,$quantity){
                $cart = Yii::$app->cart;

            $model = ProductHasMesureType::find()->where(['id'=>$id])->one();
            if ($model) {
                $cart->update($model,$quantity);
                //die(print_r($cart));
                return $this->redirect(['viewcart']);
            }
        throw new NotFoundHttpException();

    }

    public function actionViewcart(){

        $categories=Category::find()->where(['category_id'=>1])->all();
        return $this->render('cart',['categories'=>$categories]);   
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
       public function actionForgot()
   {

          
          if (!\Yii::$app->user->isGuest) {
        return $this->goHome();
    }
       $model = new ForgotForm();
           if ($model->load(Yii::$app->request->post()) && $model->find()) {
            $user=$model->find();
            $user->generatePasswordResetToken();
            if($user->save()){
              $email=  Yii::$app->mailer->compose('reset', [
            'names' => $user->names,
            'url' => Yii::$app->urlManager->createAbsoluteUrl(['site/reset','token'=>$user->password_reset_token])
            ])->setFrom('info@layolanda.com')
            ->setTo($user->username)
            ->setSubject($user->names." "."Resetea tu cuenta en LAYOLANDA")
            ->send();
                    if($email){
                        Yii::$app->getSession()->setFlash('success','No te olvides de revisar en la bandeja de spam.');
                    }
                    else{
                        Yii::$app->getSession()->setFlash('warning','Un error ha ocurrido por favor contactate con soporte técnico.');
                    }
                    return $this->goHome();
            }else{
              Yii::$app->getSession()->setFlash('warning','Un error ha ocurrido por favor contactate con soporte técnico.');  
              return $this->goHome();
            }
           
    }
        return $this->render('forgot', [
            'model' => $model,
            ]);

}
    public function actionReset($token){
    $user= User::findByPasswordResetToken($token);
     $model= New ResetForm;
    if ($model->load(Yii::$app->request->post())) {
        if($user){
            $user->removePasswordResetToken();
            $user->password=md5($model->password);
            $user->save();
         Yii::$app->getSession()->setFlash('success','Su password ha sido cambiado con éxito.');
           return $this->goHome(); 

        }else{   
           Yii::$app->getSession()->setFlash('warning','El token de seguridad es inválido o ya ha expirado.');
           return $this->goHome(); 
        }
    }
     return $this->render('reset', [
        'model' => $model,
        ]);

        }
    public function actionRegister(){
      $model = new User();
      $model->scenario="create";
      $model->type="CLIENT";
      $model->creation_date=date("Y-m-d H:i:s");
      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      $email=  Yii::$app->mailer->compose('confirm', [
    'model' => $model,
    'url' => Yii::$app->urlManager->createAbsoluteUrl(['site/confirm','id'=>$model->id,'key'=>$model->auth_key])
    ])->setFrom('info@layolanda.com')
    ->setTo($model->username)
    ->setSubject($model->names." "."Confirma tu cuenta en LAYOLANDA")
    ->send();
        if($email){
            Yii::$app->getSession()->setFlash('success','No te olvides de revisar en la bandeja de spam.');
        }
        else{
            Yii::$app->getSession()->setFlash('warning','Un error ha ocurrido por favor contactate con soporte técnico.');
        }
        return $this->redirect(['congrats', 'id' => $model->id]);

    } else {
        return $this->render('register', [
            'model' => $model,
            ]);
    }
    }
        public function actionConfirm($id, $key)
    {
        $user = User::find()->where([
        'id'=>$id,
        'auth_key'=>$key,
        'status'=>'INACTIVE',
        ])->one();
        if(!empty($user)){
        
        $user->status='ACTIVE';
        $user->save();
        Yii::$app->getSession()->setFlash('success','Felicidades tu cuenta ya está activa.');
        }
        else{
        Yii::$app->getSession()->setFlash('warning','Error, tu cuenta no pudo ser activada');
        }
        return $this->goHome();
    }
        public function actionCongrats($id){
        $model=User::findOne($id);
       return $this->render('congrats', [
            'model' => $model,
            ]); 
    }

}
