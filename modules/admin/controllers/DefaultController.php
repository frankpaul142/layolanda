<?php

namespace app\modules\admin\controllers;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;
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
        return $this->render('index');
    }
}
