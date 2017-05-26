<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Category;
use app\models\ProductHasMesureType;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
      public function beforeAction($action) {

        if (parent::beforeAction($action)) {
            $seoMetaTags = New \linchpinstudios\seo\models\Seo;
            $seoMetaTags->run();
            return true;  // or false if needed
        } else {
            return false;
        }
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $categories=Category::find()->where(['category_id'=>$model->category->category->category_id])->all();
        $types=ProductHasMesureType::find()->where(['product_id'=>$id])->all();
        return $this->render('view', [
            'model' => $model,'categories'=>$categories,'types'=>$types
        ]);
    }
    public function actionConsultMesures()
    {
        $return=array();
        $mesures=ProductHasMesureType::find()->where(['product_id'=>$_POST['product_id'],'type_id'=>$_POST['type']])->all();
        foreach($mesures as $k => $mesure){
            $return[$k]['id']=$mesure->id;
            $return[$k]['description']=$mesure->mesure->description;
            $return[$k]['price']=$mesure->price;
        }
        return json_encode($return);
    }
    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::find()->where(['id'=>$id,'status'=>'ACTIVE'])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
