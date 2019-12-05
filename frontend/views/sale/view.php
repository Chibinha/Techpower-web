<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Product;
use common\models\Sale;
use common\models\SaleItem;

    

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $sale_item_model common\models\Sale */
/* @var $profile common\models\Sale */


$this->title = 'Encomenda #' . $model->id . ' | TechPower';
$Total = 0;
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
        <?php for($i = 0 ; $i < count($sale_item_model); $i++){ ?>
            <tr>
                <td data-th="Item">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p015531-39574_1.jpg" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h5><?= $product_info[$i]['product_name'] ?></h5>
                        </div>
                    </div>
                </td>
                <td data-th="Preço" class="text-center"><?= $sale_item_model[$i]['unit_price'] ?>€</td>
                <td data-th="Quantidade" class="text-center"><?= $sale_item_model[$i]['quantity'] ?></td>           
                <td data-th="Subtotal" class="text-center"><?= $sale_item_model[$i]['unit_price'] * $sale_item_model[$i]['quantity'] ?>€</td>           
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total: <?= Sale::calcTotalSale($model->id); ?>€</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total: <?= Sale::calcTotalSale($model->id); ?>€</strong></td>
            </tr>
        </tfoot>
    </table>
</div>