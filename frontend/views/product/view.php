<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->product_name . ' | TechPower';
?>
<div class="product-view">

    <h2 class="product-name"><?= Html::encode($model->product_name) ?></h2>

    <?= Html::img('@web/images/' . $model->product_image, ['class' => 'product-image col-md-6 col-lg-5']); ?>

    <h4>Descrição</h4>
    <p><?= Html::encode($model->description) ?></p>

    <div class="product-bottom">
        <h4 class="product-price"><?= Html::encode($model->unit_price) ?>€</h4>
        <?= Html::a('Add to cart', ['cart/addcart', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>

</div>