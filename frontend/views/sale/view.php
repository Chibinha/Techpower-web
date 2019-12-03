<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $sale_item_model common\models\Sale */
/* @var $profile common\models\Sale */


$this->title = 'Encomenda #' . $model->id . ' | TechPower';
?>

<div class="sale-view">
    <h1>Encomenda #<?= $model->id ?></h1>
    <br>
    <h4 style="font-weight: bold;">Morada de entrega</h4>
    <p><?= $profile['firstName'], " " , $profile['lastName']?></p>
    <p><?= $profile['address']?></p>
    <p><?= $profile['city']?></p>
    <p><?= $profile['postal_code']?></p>
    <p><?= $profile['country']?></p>
    <hr>
    <h4 style="font-weight: bold;">Resumo de compra</h4>
    <table class="table">
        <thead>
            <tr>
                <th style="width:40%">Item</th>
                <th style="width:15%" class="text-center">Preço</th>
                <th style="width:15%" class="text-center">Quantidade</th>
                <th style="width:15%" class="text-center">Subtotal</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($sale_item_model as $item){ 
            // **Needs refactoring** Procura os dados do produto através do id_product na tabela sale_item
            $product_id = $item['id_product'];
            $product_info = Product::find()->where(['id' => $product_id])->one();  ?>

            <tr>
                <td data-th="Item">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p015531-39574_1.jpg" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h5><?= $product_info['product_name'] ?></h5>
                        </div>
                    </div>
                </td>
                <td data-th="Preço" class="text-center"><?= $item['unit_price'] ?>€</td>
                <td data-th="Quantidade" class="text-center"><?= $item['quantity'] ?></td>           
                <td data-th="Subtotal" class="text-center"><?= $item['unit_price'] * $item['quantity'] ?>€</td>           
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total: <?= $model->total_amount?>€</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total: <?= $model->total_amount?>€</strong></td>
            </tr>
        </tfoot>
    </table>
</div>