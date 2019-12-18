<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\Product;

class CategoryController extends ActiveController
{
    public $modelClass = 'common\models\Category';

    //http://localhost:8080/api/categories/products/{id}
    public function actionProducts($id)
    {
        $catmodel = new $this->modelClass;
        $productsmodel = Product::find()->where("id_category=" . $id)->all();
        return ['products' => $productsmodel];
    }
}
