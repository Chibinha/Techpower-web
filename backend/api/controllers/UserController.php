<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Profile;
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
            'except' => ['create'],
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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['view']);
        unset($actions['update']);
        return $actions;
    }

    public function actionLogin()
    {
        $userData = User::find()->where(['id' => Yii::$app->user->getId()])->select([
            "id",
            "username",
            "auth_key",
            "email"
        ])->asArray()->one();
        $profile = Profile::find()->where(['id_user' => Yii::$app->user->getId()])->select([
            "firstName",
            "lastName",
            "phone",
            "address",
            "nif",
            "postal_code",
            "city",
            "country"
        ])->asArray()->one();

        return array_merge($userData, $profile);
    }

    public function actionView($id)
    {
        $user = User::find($id)->asArray()->one();
        $profile = Profile::find()->where(['id_user' => $id])->asArray()->one();

        return array_merge($user, $profile);
    }

    public function actionCreate() {
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

    public function actionUpdate($id){

        $user = User::findOne($id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException("The user was not found.");
        }

        $profile = Profile::findOne($user->id);
        if (!$profile) {
            throw new \yii\web\NotFoundHttpException("The user has no profile.");
        }

        $username =\Yii::$app->request->post('username');
        $email =\Yii::$app->request->post('email');
        $firstName =\Yii::$app->request->post('firstName');
        $lastName =\Yii::$app->request->post('lastName');
        $phone =\Yii::$app->request->post('phone');
        $address =\Yii::$app->request->post('address');
        $nif =\Yii::$app->request->post('nif');
        $postal_code =\Yii::$app->request->post('postal_code');
        $city =\Yii::$app->request->post('city');
        $country =\Yii::$app->request->post('country');

        $user->username = $username;
        $user->email = $email;
        $profile->firstName = $firstName;
        $profile->lastName = $lastName;
        $profile->phone = $phone;
        $profile->address = $address;
        $profile->nif = $nif;
        $profile->postal_code = $postal_code;
        $profile->city = $city;
        $profile->country = $country;

        if($user->validate() && $profile->validate()) {
            $profile->save();
            $user->save();
            $response['isSuccess'] = 201;
            $response['message'] = 'Dados do utilizador alterados com sucesso!';
            return $response;
        }
        else {
            throw new \yii\web\BadRequestHttpException("The request could not be understood by the server due to malformed syntax.");
        }       
    }
}
