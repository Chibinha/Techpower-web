<?php

namespace app\api\controllers;

use common\models\Category;
use Yii;
use yii\rest\ActiveController;
use common\models\Product;
use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class CategoryController extends ActiveController
{
    public $modelClass = 'common\models\Category';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['index', 'view', 'products'],
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password)
                    {
                        $user = User::findByUsername($username);
                        if ($user && $user->validatePassword($password))
                        {
                            return $user;
                        }
                    }
                ],
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex() {
        return Category::find()->all();
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

    //http://localhost:8080/api/categories/{id}/products
    public function actionProducts($id)
    {
        $products = Product::find()->where("id_category=" . $id)->all();
        return $products;
    }
}
