<?php

namespace app\api\controllers;
use common\models\Product;

use Yii;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

    //http://localhost:8081/api/products/name/{name}
    public function actionTeste($value)
    {
         var_dump($value);
         die();
        $productmodel = Product::find()->where(['id' => $id]);
        return ['product' => $productmodel];
    }
}