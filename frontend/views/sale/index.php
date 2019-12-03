<?php

use frontend\controllers\SaleController;
use common\models\Sale;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Encomendas | TechPower';

?>
<div class="sale-index">

    <h1>Encomendas</h1>

    <table class="table">
        <thead>
            <tr>
                <th style="width:15%">Numero</th>
                <th style="width:15%">Data</th>
                <th style="width:15%">Total</th>
                <th style="width:15%">Estado</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order){ ?>
            <tr>
                <td data-th="Numero">
                    <div class="row">
                        <div class="col-sm-9">
                            <h5><?= $order['id'] ?></h5>
                        </div>
                    </div>
                </td>
                <td data-th="Data"><?= $order['sale_date'] ?></td>
                <td data-th="Total"><?= $order['total_amount'] ?>€</td>
                <td data-th="Estado"><?php Sale::getSaleState($order)?>
                </td>
                <td class="view">
                    <a href="<?=Url::to(['sale/view', 'id' => $order["id"]]); ?>" class="btn btn-warning btn-sm">Ver</a>								
                </td>        
            </tr>
            <?php } 
            ?> 
        </tbody>
    </table>
</div>