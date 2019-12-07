<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;

class ProfileController extends ActiveController
{
    public $modelClass = 'common\models\Profile';
}
