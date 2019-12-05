<?php

namespace frontend\controllers;

use Yii;
use common\models\Sale;
use common\models\SaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SaleItem;
use common\models\User;
use common\models\Profile;

use common\models\PayPalClient;
use common\models\Product;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $orders = Sale::find()->orderBy(['id' => SORT_DESC])->asArray()->where(['id_user' => Yii::$app->user->id])->all();
        
        return $this->render('index', [
            'orders' =>$orders,
        ]);
    }

    /**
     * Displays a single Sale model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // Procura as linhas de venda com o mesmo id do que a encomenda
        $sale_item_model = SaleItem::find()->asArray()->where(['id_sale' => $id])->all();

        // Procura os dados do Profile através de relacionamentos de tabelas
        $sale = Sale::findOne($id);
        $user_id=$sale['id_user'];
        $get_profile = Profile::findOne($user_id);

        // Procura o nome do produto que está na linha de venda
        

        return $this->render('view', [
            'model' => $this->findModel($id),
            'sale_item_model' => $sale_item_model,
            'profile' => $get_profile,
        ]);
    }

    /**
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $cart = [];
            if ($session->has('cart')) {
                $cart = $session->get('cart');
            }
        }

        $sale = new Sale();
        $sale->id_user = 2;
        $sale->sale_finished = 0;

        $transaction = $sale->getDb()->beginTransaction();
        $sale->save(false);
        foreach($cart as $product) {
            $model = Product::find($product)->one();

            $orderItem = new SaleItem();
            $orderItem->id_sale = $sale->id;
            $orderItem->unit_price = $model->unit_price;
            $orderItem->id_product = $product;
            // TODO: Save quantity to session
            $orderItem->quantity = 1;
            if (!$orderItem->save(false)) {
                $transaction->rollBack();
                \Yii::$app->session->addFlash('error', 'Não foi possivel gravar a sua encomenda.');
                return $this->redirect('site/cart');
            }
        }
        $transaction->commit();
        \Yii::$app->session->addFlash('success', 'Encomenda gravada com sucesso.');

        // Delete cart
        $cart = [];
        $session->set('cart', $cart);

        return $this->redirect(['site/index']);
    }

    /**
     * Updates an existing Sale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // 2. Set up your server to receive a call from the client
    /**
    *You can use this function to retrieve an order by passing order ID as an argument.
    */
    public static function actionGetorder($orderId)
    {
        // 3. Call PayPal to get the transaction details
        $client = PayPalClient::client();
        $response = $client->execute(new OrdersGetRequest($orderId));
        /**
         *Enable the following line to print complete response as JSON.
        */
        print json_encode($response->result);
        print "Status Code: {$response->statusCode}\n";
        print "Status: {$response->result->status}\n";
        print "Order ID: {$response->result->id}\n";
        print "Intent: {$response->result->intent}\n";
        print "Links:\n";
        foreach($response->result->links as $link)
        {
            print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
        }
        // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
        print "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";

        // To print the whole response body, uncomment the following line
        //echo json_encode($response->result, JSON_PRETTY_PRINT);
    }
}
