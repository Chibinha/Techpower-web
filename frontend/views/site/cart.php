<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Checkout';
?>

<div class="site-cart">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <hr>
   <h3>Morada de envio</h3>
   <p>John Doe</p>
   <p>Rua da escola do politécnico de Leiria</p>
   <p>2210-221, Leiria</p>
   <p>Portugal</p>

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
            <tr>
                <td data-th="Item">
                    <div class="row">
                        <div class="col-sm-2 hidden-xs"><img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p015531-39574_1.jpg" alt="..." class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h5>Processador Intel Core i9-9900KS Octa-Core 4.0GHz c/ Turbo 5.0GHz 16MB Skt1151</h5>
                        </div>
                    </div>
                </td>
                <td data-th="Preço">596,90€</td>
                <td data-th="Quantidade">
                    <input type="number" class="form-control text-center" value="1">
                </td>
                <td data-th="Subtotal:" class="text-center">596,90€</td>
                <td class="remove">
                    <button class="btn btn-danger btn-sm">Remover Item <i class="glyphicon glyphicon-trash"></i></button>								
                </td>               
            </tr>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>Total: 596,90€</strong></td>
            </tr>
            <tr>
                <td colspan="3" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>Total 596,90€</strong></td>
                <td><a href="#" class="btn btn-success btn-block">Finalizar compra</a></td>
            </tr>
        </tfoot>
    </table>
</div>
</div>
            
