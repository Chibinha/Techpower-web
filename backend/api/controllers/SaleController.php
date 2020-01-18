<?php

namespace app\api\controllers;

use Yii;
use common\models\Sale;
use common\models\User;
use common\models\Product;
use common\models\SaleItem;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class SaleController extends ActiveController
{
    public $modelClass = 'common\models\Sale';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
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
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        return $actions;
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

    public function actionIndex()
    {
        $sales = Sale::find()->where(['id_user' => Yii::$app->user->id])->all();

        $sales_array = [];

        foreach ($sales as $sale)
        {
            $sale_array = Sale::find()->where(['id' => $sale->id])->asArray()->one();
            $products_array = SaleItem::find()->where(['id_sale' => $sale->id])->asArray()->all();

            array_push($sales_array, array_merge($sale_array, array('products' => $products_array)));
        }
        return $sales_array;
    }

    public function actionView($id)
    {
        $sale_object = Sale::findOne($id);
        if ($sale_object->id_user == Yii::$app->user->id)
        {
            $sale_array = Sale::find()->where(['id' => $id])->asArray()->one();
            $products_array = SaleItem::find()->where(['id_sale' => $id])->asArray()->all();
            
            return array_merge($sale_array, array('products' => $products_array));
        }
    }

    /**
     * To create pass product id as key and quantity as value
     */
    public function actionCreate()
    {
        $params = Yii::$app->request->post();

        $sale = new Sale();
        $sale->id_user = Yii::$app->user->getId();
        $sale->sale_finished = 0;
        $sale->save(false);

        $transaction = $sale->getDb()->beginTransaction();
        foreach ($params as $product)
        {
            $model = Product::findOne($product['id']);
            $orderItem = new SaleItem();
            $orderItem->id_sale = $sale->id;
            $orderItem->unit_price = $model->unit_price;
            $orderItem->id_product = $model->id;
            $orderItem->quantity = $product['quantity'];
            if (!$orderItem->save(false)) {
                $transaction->rollBack();
                $sale->getErrors();
                $response['hasErrors'] = $sale->hasErrors();
                $response['errors'] = $sale->getErrors();
                return $response;
            }
        }
        $transaction->commit();
        $response['isSuccess'] = 201;
        $response['message'] = 'Venda Registada com sucesso!';
        return $response;
    }

    public function actionUpdate($id){

        $params = Yii::$app->request->post();

        $sale = Sale::findOne($id);
        if (!$sale) {
            throw new \yii\web\NotFoundHttpException("The sale was not found.");
        }

        $sale->sale_finished = $params['sale_finished'];
        $sale->save();
        $response['isSuccess'] = 200;
        $response['message'] = 'Venda atualizada com sucesso!';
        return $response;   
    }
}
