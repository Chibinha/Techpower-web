<?php

use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'TechPower Online - Loja de Informática';
?>

<div class="site-index">
    <div class="panel panel-default">
        <span class="special">| </span> <span class="title">Novidades</span>
        <div class="panel-body">
            <?php foreach($popular_products as $product){ ?>
                <div class="card col-xs-6 col-md-4">
                    <a href="<?=Url::to(['product/view', 'id' => $product["id"]]); ?>">
                    <img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p006949-517_1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= StringHelper::truncate(Html::encode($product['product_name']), 42) ?></h5>
                        <p class="card-text description"><?= StringHelper::truncate(Html::encode(($product['description'])), 58)?></p>
                        <p class="card-text price"><?= $product['unit_price'] ?>€</p>
                    </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <a type="button" class="btn btn-warning">Ver Novidades</a>
    </div>

    <br>

    <div class="panel panel-default">
        <span class="special">| </span> <span class="title">Destaques</span>
        <div class="panel-body">
            <?php foreach($new_products as $product){ ?>
                <div class="card">
                    <a href="<?=Url::to(['product/view', 'id' => $product["id"]]); ?>">
                    <img src="https://d3ift91kaax4b9.cloudfront.net/media/catalog/product/cache/33ba37c1fda6d70c703e88ff79ea1021/p/r/product-p006949-517_1.jpg" class="card-img-top" alt="...">
                    <div class="card-body bg-dark">
                        <h5 class="card-title"><?= StringHelper::truncate(Html::encode($product['product_name']), 42) ?></h5>
                        <p class="card-text description"><?= StringHelper::truncate(Html::encode(($product['description'])), 58)?></p>
                        <p class="card-text price"><?= $product['unit_price'] ?>€</p>
                    </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <a type="button" class="btn btn-warning">Ver Destaques</a>
    </div>
</div>