<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use sjaakp\alphapager\ActiveDataProvider;
use app\models\Product;
use app\models\ProductSearch;
use yii\data\Sort;
/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArtist()    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->joinWith('artist')->orderBy('name'),
            'alphaAttribute' => 'name'
        ]);

        return $this->render('artist', [
            'dataProvider' => $dataProvider
        ]);
    }
    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $categories=Category::find()->where(['category_id'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),'categories'=>$categories
        ]);
    }
    public function actionSubcategory($id)
    {
        $model=$this->findModel($id);
        $categories=Category::find()->where(['category_id'=>$model->category->category_id])->orderBy(['sort' => SORT_ASC])->all();
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$model->id);
            $sort = new Sort([
        'attributes' => [
            'title' =>[
                'label' =>'Título'
            ]
        ],
    ]);
        return $this->render('subcategory', [
            'model' => $model,'categories'=>$categories,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sort'=>$sort
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
