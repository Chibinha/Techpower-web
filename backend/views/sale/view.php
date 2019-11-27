<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = $model->id;
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

    
    <?= GridView::widget([
        'dataProviderSale' => $dataProviderSale,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'text',
                'label' => 'Name',
                'value' => function ($user) {
                    return User::findById($user->id)['username'];
                },
            ],
            'sale_date',
            'total_amount',
            'sale_finished:boolean',
        ],
    ]); ?>

    <?= GridView::widget([
        'dataProviderSaleItem' => $dataProviderSaleItem,
        'columns' => [
           /*  [
                'label' => 'Item',
                'value' => Html::encode(Product->find($)),
            ], */
            'unit_price',
            'quantity',
        ],
    ]); ?>
</div>
