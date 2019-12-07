<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';
}
