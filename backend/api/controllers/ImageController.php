<?php

namespace app\api\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;

class ImageController extends Controller
{
    public function actionIndex($name)
    {
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type', 'image/png');
        \Yii::$app->response->data = file_get_contents(Yii::getAlias("@frontend/web/images/") . $name);
        return \Yii::$app->response;

        //return Yii::$app->response->sendFile(Yii::getAlias("@frontend/web/images/") . "13636e66998c5e8dc2d36de1080b1568.png");
    }
}
