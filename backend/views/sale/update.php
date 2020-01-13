<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Sale;
use common\models\User;
use common\models\SaleItem; 
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = 'Update Sale: #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

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

        <?php 
        $sale_items = SaleItem::find()->where(['id_sale' => $model->id])->all();
        if (sizeof($sale_items) == 0)
        {?>
            <td><h4><b>Esta venda não contem nenhuns produtos.</td>
        <?php }
       else
        {
            foreach($sale_items as $item)
            { 
                // **Needs refactoring** Procura os dados do produto através do id_product na tabela sale_item
                $product_id = $item->id_product;
                $product_info = Product::find()->where(['id' => $product_id])->one(); ?>
                <tr>
                    <td data-th="Item">
                        <div class="row">
                            <div class="col-sm-9">
                                <h5><?= $product_info['product_name'] ?></h5>
                            </div>
                        </div>
                    </td>
                    <td data-th="Preço" class="text-center"><?= $item->unit_price ?>€</td>
                    <td data-th="Quantidade" class="text-center"><?= $item->quantity ?></td>           
                    <td data-th="Subtotal" class="text-center"><?= $item->unit_price * $item->quantity ?>€</td>       
                    <td class="remove">
                        <?= Html::a('Remover Item',  ['sale-item/removeitem', 'id' => $item->id],  ['class' => 'btn btn-danger btn-sm']) ?>
                    </td>  
                </tr>
            <?php } 
        };?>
</div>
