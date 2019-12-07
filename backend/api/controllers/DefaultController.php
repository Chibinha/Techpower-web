<?php

namespace app\api\controllers;

use common\models\User;
use yii\debug\models\search\User as SearchUser;
use yii\web\Controller;
use yii\filters\auth\HttpBasicAuth;

/**
 * Default controller for the `api` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password)
            {
                $user = User::findByUsername($username);
                if ($user && $user->validatePassword($password))
                {
                    return $user;
                }
            }
        ];
        return $behaviors;      
    }


}
