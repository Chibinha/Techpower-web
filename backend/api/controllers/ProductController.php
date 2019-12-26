<?php

namespace app\api\controllers;
use common\models\Product;
use yii\filters\auth\QueryParamAuth;

use Yii;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

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

    //http://localhost:8081/api/products/name/{name}
    public function actionProductsbyname($name)
    {
        $productmodel = Product::find()->where(['like', 'product_name', $name])->limit(12)->orderBy(['id' => SORT_DESC])->asArray()->all();
        return ['product' => $productmodel];
    }
}