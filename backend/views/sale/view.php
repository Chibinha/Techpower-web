<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\grid\GridView;
use common\models\Sale;
use common\models\User;
use yii\helpers\VarDumper;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$user = User::find()->where(['id' => $model->id_user])->One();
$this->title = "Sale #" . $model->id . " by " . $user->username;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="sale-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
                <td data-th="Cliente"><?= $cliente->firstName ?></td>
                <td data-th="Data"><?= $model->sale_date ?></td>
                <td data-th="Total"><?= $model->total ?></td>
                <td data-th="Estado"><?= $model->SaleState ?></td> 
            </tr> 
        </tbody>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th style="width:15%">Cliente</th>
                <th style="width:15%">Telefone</th>
                <th style="width:15%">Endereço</th>
                <th style="width:15%">Codigo Postal</th>
                <th style="width:15%">Cidade</th>
                <th style="width:15%">País</th>
                <th style="width:1%"></th>
            </tr>
        </thead>
        <tbody>
                <td data-th="Cliente"><?= $cliente->firstName ?></td>
                <td data-th="Telefone"><?= $cliente->phone ?></td>
                <td data-th="Endereço"><?= $cliente->address ?></td>
                <td data-th="Codigo Postal"><?= $cliente->postal_code ?></td> 
                <td data-th="Cidade"><?= $cliente->city ?></td> 
                <td data-th="País"><?= $cliente->country ?></td> 
            </tr> 
        </tbody>
    </table>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
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
