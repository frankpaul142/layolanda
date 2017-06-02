<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Address;
use app\models\Bill;
use app\models\AddressSearch;
use yii\filters\AccessControl;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
                                        'access' => [
           'class' => AccessControl::className(),
           'only' => ['index', 'update', 'address', 'createaddress','updateaddress','orders','detail'],
           'rules' => [

               [
                   'actions' => ['index','update','address','createaddress','updateaddress','orders','detail'],
                   'allow' => true,
                   'roles' => ['@'],
               ],
           ],
       ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
            $this->redirect(['create']);
        return $this->render('index', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->user->identity->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actinoUpdatepassword(){

    }
    public function actionAddress()
    {
     $searchModel = new AddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['user_id'=>Yii::$app->user->identity->id]);
        return $this->render('address', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     public function actionCreateaddress()
    {
        $model = new Address();
        $model->creation_date=date('Y-m-d H:i:s');
        $model->user_id=Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['address', 'id' => $model->id]);
        } else {
            return $this->render('createaddress', [
                'model' => $model,
            ]);
        }
    }
      public function actionUpdateaddress($id)
    {
        $model = Address::find()->where(['id'=>$id,'user_id'=>Yii::$app->user->identity->id])->one();
        if(!$model){
            Yii::$app->getSession()->setFlash('warning','Dirección no encontrada.');
           return $this->redirect(['address']); 
        } 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['address']);
        } else {
            return $this->render('updateaddress', [
                'model' => $model,
            ]);
        }
    }
    public function actionOrders(){
           $id=Yii::$app->user->identity->id;
                $model = $this->findModel($id);
                return $this->render('orders', [
                    'model' => $model,
                ]);
    }
      public function actionDetail($id)
    {
        $model = Bill::find()->where(['id'=>$id,'user_id'=>Yii::$app->user->identity->id])->one();
        if(!$model){
            Yii::$app->getSession()->setFlash('warning','Detalle de compra no encontrado.');
           return $this->redirect(['index']); 
        } 

            return $this->render('detail', [
                'model' => $model,
            ]);
        
    }
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
