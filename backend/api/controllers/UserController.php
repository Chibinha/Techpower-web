<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\User;
use frontend\models\SignupForm;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';
    
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['login', 'signup'],
            'authMethods' => [
                HttpBasicAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;      
    }

    public function actionLogin()
    {
        $post = Yii::$app->request->post();

        $user = User::findByUsername($post['username']);
        if ($user && $user->validatePassword($post['password']))
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return array('auth-key' => $user->auth_key);
        }
    }

    //http://localhost:8080/api/user/signup
    public function actionSignup() {
        $model = new SignupForm();
        $params = Yii::$app->request->post();
        $model->username = $params['username'];
        $model->email = $params['email'];
        $model->password = $params['password'];

        $model->firstName = $params['firstName'];
        $model->lastName = $params['lastName'];
        $model->phone = $params['phone'];
        $model->address = $params['address'];
        $model->nif = $params['nif'];
        $model->postal_code = $params['postal_code'];
        $model->city = $params['city'];
        $model->country = $params['country'];

        if ($model->signup()) {
            $response['isSuccess'] = 201;
            $response['message'] = 'Utilizador registado com sucesso!';
            return $response;   
        }
        else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            return $response;
        }
    }
}
