<?php

namespace app\api\controllers;

use Yii;
use common\models\Sale;
use common\models\User;
use common\models\Product;
use common\models\SaleItem;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

class SaleController extends ActiveController
{
    public $modelClass = 'common\models\Sale';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'except' => ['index', 'view'],
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
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

    public function actionCreate()
    {
        $params = Yii::$app->request->post();
        
        $sale = new Sale();
        $sale->id_user = Yii::$app->user->getId();
        $sale->sale_finished = 0;
        $sale->save();

        $transaction = $sale->getDb()->beginTransaction();
        foreach ($params as $id => $quantity) {
            $model = Product::findOne($id);

            $orderItem = new SaleItem();
            $orderItem->id_sale = $sale->id;
            $orderItem->unit_price = $model->unit_price;
            $orderItem->id_product = $model->id;
            $orderItem->quantity = $quantity;
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

    
}
