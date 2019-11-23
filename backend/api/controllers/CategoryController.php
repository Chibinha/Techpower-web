<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;

class CategoryController extends ActiveController
{
    public $modelClass = 'common\models\Category';
}
