<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->product_name;
?>
<div class="product-view">

    <h3><?= Html::encode($model->product_name) ?></h3>

    <img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p006949-517_1.jpg" class="card-img-top" alt="...">

    <p><?= Html::encode($model->description) ?></p>

    <p><?= Html::encode($model->unit_price) ?>€</p>

</div>