<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Sale;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales for Shipping';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th style="width:15%">Cliente</th>
                <th style="width:15%">Data</th>
                <th style="width:15%">Total</th>
                <th style="width:15%">Estado</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        
        <?php 
        $sale_not_finished = Sale::find()->where(['sale_finished' => 0])->all();
        if (sizeof($sale_not_finished) == 0)
        {?>
            <td><h5><b>Não existem vendas para expedição</td>
        <?php }
        else
        {
            foreach($sale_not_finished as $sale)
            { 
                $cliente = User::find()->where(['id' => $sale->id_user])->one(); ?>

                <tbody>
                    <td data-th="Cliente"><?= $cliente->username ?></td>
                    <td data-th="Data"><?= $sale->sale_date ?></td>
                    <td data-th="Total"><?= $sale->total ?></td>
                    <td data-th="Estado"><?= $sale->SaleState ?></td> 
                    <td class="update">
                        <?= Html::a('Update',  ['sale/update', 'id' => $sale->id],  ['class' => 'btn btn-primary']) ?>
                    </td>  
                </tbody>
            <?php } 
        }?>

    </table>



</div>
