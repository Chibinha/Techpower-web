<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\User;
use common\models\Sale;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sale-view">

    <h1>Sale #<?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
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
        <tbody>
                <td data-th="Cliente"><?= $cliente['username'] ?></td>
                <td data-th="Data"><?= $model['sale_date'] ?></td>
                <td data-th="Total"><?= $model['total_amount'] ?>€</td>
                <!-- <td data-th="Estado"><?php /* Sale::getSaleState($order) */?> -->
                </td>      
            </tr>
        </tbody>
    </table>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Produto',
                'value' => 'product.product_name'
            ],
            [
                'attribute' => 'Preço por Unidade',
                'value' => 'unit_price'
            ],
            [
                'attribute' => 'Quantidade',
                'value' => 'quantity'
            ],
        ]
    ]); ?>
</div>
