<?php

namespace app\api\controllers;
use common\models\Product;

use Yii;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

    //http://localhost:8081/api/products/{name}
    public function actionProductsByName($id){

        $productsmodel = Product::find()->where("product_name=".)->all();
        return ['products' => $productsmodel];
    }
}