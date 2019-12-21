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
            ];   
         return $behaviors; 
    }

    public function actionCreateSale()
    {
        $params = Yii::$app->request->post();
        
        $sale = new Sale();
        $sale->id_user = Yii::$app->user->getId();
        $sale->sale_finished = 0;
        $sale->sale_date = date("d/m/Y");
        $sale->save();

        $transaction = $sale->getDb()->beginTransaction();
        foreach ($params['id'] as $product) {
            $model = Product::find($product)->one();
            
            $orderItem = new SaleItem();
            $orderItem->id_sale = $sale->id;
            $orderItem->unit_price = $model->unit_price;
            $orderItem->id_product = $product;
            $orderItem->quantity = $params['quantity'];
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
