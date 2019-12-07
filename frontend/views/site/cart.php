<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Carrinho | TechPower';
$this->registerJsFile('@web/js/script.js',['depends' => [\yii\web\JqueryAsset::className()]]);
// Import Paypal API
$this->registerJsFile('https://www.paypal.com/sdk/js?client-id=AaTG6AWmTKiOm3nUJ5VsAKcTxGDtijOr2y8X5jI2cGIHYMJOOQnzJ1IiGvAQznV0PMsxWEhFRf-WaqA9&currency=EUR');
?>

<div class="site-cart">
    <h1>Checkout</h1>
    <div class="container">
    <hr>
    <h3>Morada de Entrega</h3>
    <?php if(Yii::$app->user->isGuest){ ?>
    <a href="login">Inicie Sessão</a>
    <?php } else {?>
    <p><?= $profile['firstName'], " " , $profile['lastName']?></p>
    <p><?= $profile['address']?></p>
    <p><?= $profile['postal_code'], ", ", $profile['city']?></p>
    <p><?= $profile['country']?></p>
    <?php } ?>

   <hr>

   <h3>Carrinho</h3>
	<table class="table">
        <thead>
            <tr>
                <th style="width:50%">Item</th>
                <th style="width:10%">Preço</th>
                <th style="width:8%">Quantidade</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($cart); $i++) { ?>
                <tr>
                    <td data-th="Item">
                        <div class="row">
                            <div class="col-sm-2 hidden-xs"><img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p015531-39574_1.jpg" alt="..." class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h5><?= $cart[$i]->product_name ?></h5>
                            </div>
                        </div>
                    </td>
                    <td data-th="Preço" class="preco"><?= $cart[$i]->unit_price ?>€</td>
                    <td data-th="Quantidade">
                        <?php $form = ActiveForm::begin(['action' => ['cart/quantity', 'id' => $cart[$i]->id],]) ?>
                            <input onchange="this.form.submit()" name="quantity" type="number" class="quantidade form-control text-center" value="<?= $quantity[$i] ?>" min="1" oninput="validity.valid||(value='1');">
                        <?php ActiveForm::end() ?>
                    </td>
                    <td id="subtotal" data-th="Subtotal:" class="subtotal text-center"><?= $subtotal[$i] ?>€</td>
                    <td class="remove">
                        <?= Html::a('Remover Item', ['cart/removecart', 'id' => $cart[$i]->id], ['class' => 'btn btn-danger btn-sm']) ?>
                    </td>         
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total: <?= $total ?>€</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total <?= $total ?>€</strong></td>
                <td><div id="paypal-button-container"></div></td>
            </tr>
        </tfoot>
    </table>
</div>
</div>
            
