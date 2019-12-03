<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = 'Update Sale: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-update">

    <h1>Sale #<?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Produto',
                'value' => 'product.product_name'
            ],
            [
                'attribute' => 'Produto',
                'value' => 'product.unit_price'
            ],
            ['class' => 'yii\grid\CheckboxColumn',],
                // you may configure additional properties here
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
