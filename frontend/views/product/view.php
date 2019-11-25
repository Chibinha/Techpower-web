<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->product_name;
?>
<div class="product-view">

    <h2 class="product-name"><?= Html::encode($model->product_name) ?></h2>
    
    <img class="product-image col-md-6 col-lg-5" src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p006949-517_1.jpg" alt="...">
    
    <h4>Descrição</h4>
    <p><?= Html::encode($model->description) ?></p>
    
    <div class="product-bottom">
        <h4 class="product-price"><?= Html::encode($model->unit_price) ?>€</h4>
        <?= Html::a('Add to cart', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

</div>