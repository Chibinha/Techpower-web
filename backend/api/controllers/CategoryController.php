<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\Product;
use yii\filters\auth\QueryParamAuth;

class CategoryController extends ActiveController
{
    public $modelClass = 'common\models\Category';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['index', 'view'],
        ];
        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        // check if the user can access $action and $model
        // throw ForbiddenHttpException if access should be denied
        if ($action === 'create' || $action === 'update' || $action === 'delete') {
            if(\Yii::$app->user->isGuest)
                throw new \yii\web\ForbiddenHttpException('Your request was made with invalid credentials.');
        }
    }

    //http://localhost:8080/api/categories/products/{id}
    public function actionProducts($id)
    {
        $catmodel = new $this->modelClass;
        $productsmodel = Product::find()->where("id_category=" . $id)->all();
        return ['products' => $productsmodel];
    }
}
