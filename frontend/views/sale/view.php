<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = 'Encomenda #' . $model->id . ' | TechPower';
?>
<div class="sale-view">
    <h1>Encomenda #<?= $model->id ?></h1>
    <br>
    <h4 style="font-weight: bold;">Morada de entrega</h4>
    <p>John Doe</p>
    <p>Rua Professor piedade Arinto, lote nº 1</p>
    <p>Leiria</p>
    <p>2120-500</p>
    <p>Portugal</p>
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
            <tr>
                <td data-th="Item">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p015531-39574_1.jpg" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h5>Processador Intel Core i9-9900KS Octa-Core 4.0GHz c/ Turbo 5.0GHz 16MB Skt1151</h5>
                        </div>
                    </div>
                </td>
                <td data-th="Preço" class="text-center">596,90€</td>
                <td data-th="Quantidade" class="text-center">1</td>           
                <td data-th="Subtotal" class="text-center">596,90€</td>           
            </tr>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total: 596,90€</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total 596,90€</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
