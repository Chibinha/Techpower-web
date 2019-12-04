<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Carrinho | TechPower';
$this->registerJsFile('@web/js/script.js',['depends' => [\yii\web\JqueryAsset::className()]]);
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
    <p><?= $profile['city']?></p>
    <p><?= $profile['postal_code']?></p>
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
            <?php foreach ($cart as $product) { ?>
                <tr>
                    <td data-th="Item">
                        <div class="row">
                            <div class="col-sm-2 hidden-xs"><img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p015531-39574_1.jpg" alt="..." class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h5><?= $product->product_name ?></h5>
                            </div>
                        </div>
                    </td>
                    <td data-th="Preço" class="preco"><?= $product->unit_price ?>€</td>
                    <td data-th="Quantidade">
                        <input type="number" class="quantidade form-control text-center" min="0" value="1">
                    </td>
                    <td id="subtotal" data-th="Subtotal:" class="subtotal text-center"><?= $product->unit_price ?>€</td>
                    <td class="remove">
                        <?= Html::a('Remover Item', ['product/removecart', 'id' => $product->id], ['class' => 'btn btn-danger btn-sm']) ?>
                    </td>         
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total: <span class="total"><span>€</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total <span class="total"><span>€</strong></td>
                <td><a href="#" class="btn btn-success btn-block">Finalizar compra</a></td>
            </tr>
        </tfoot>
    </table>
</div>
</div>
            
