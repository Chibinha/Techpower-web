<?php

namespace app\api\controllers;
use common\models\Product;

use Yii;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

    //http://localhost:8081/api/products/name/{name}
    public function actionProductsbyname($name)
    {
        $productmodel = Product::find()->where(['like', 'product_name', $name])->limit(12)->orderBy(['id' => SORT_DESC])->asArray()->all();
        return ['product' => $productmodel];
    }
}