<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */

$this->title = 'Update Sale: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        <?php foreach($model as $item){ 
            // **Needs refactoring** Procura os dados do produto através do id_product na tabela sale_item
            $product_id = $item['id_product'];
            $product_info = Product::find()->where(['id' => $product_id])->one();  ?>

            <tr>
                <td data-th="Item">
                    <div class="row">
                        <div class="col-sm-9">
                            <h5><?= $product_info['product_name'] ?></h5>
                        </div>
                    </div>
                </td>
                <td data-th="Preço" class="text-center"><?= $item['unit_price'] ?>€</td>
                <td data-th="Quantidade" class="text-center"><?= $item['quantity'] ?></td>           
                <td data-th="Subtotal" class="text-center"><?= $item['unit_price'] * $item['quantity'] ?>€</td>           
            </tr>
        <?php } ?>
</div>
