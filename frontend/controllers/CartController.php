<?php

namespace frontend\controllers;

use Yii;
use common\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class CartController extends Controller
{
/**
     * Adds Product to the cart.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAddcart($id)
    {
        $product = (string)Yii::$app->request->get('id');

        $session = Yii::$app->session;
        if ($session->isActive) {
            if ($session->has('cart')) {
                $cart = $session->get('cart');
            }
                $cart[$product] = 1;
            $session->set('cart', $cart);
        }

        \Yii::$app->session->addFlash('success', 'Produto adicionado ao carrinho.');

        return $this->redirect(['site/index']);
    }

    /**
     * Removes Product on the cart.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRemovecart($id)
    {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $cart = [];
            if ($session->has('cart')) {
                $cart = $session->get('cart');
                unset($cart[$id]);
            }
            $session->set('cart', $cart);
        }

        return $this->redirect(['site/cart']);
    }

    /**
     * Add quantity to Product on the cart.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionQuantity($id)
    {
        $quantity = Yii::$app->request->post('quantity');

        $session = Yii::$app->session;
        if ($session->isActive) {
            $cart = [];
            if ($session->has('cart')) {
                $cart = $session->get('cart');
            }

            $cart[(string)$id] = $quantity;

            $session->set('cart', $cart);
        }

        return $this->redirect(['site/cart']);
    }
}