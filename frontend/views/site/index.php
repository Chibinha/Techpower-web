<?php

use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'TechPower Online - Loja de Informática';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="panel panel-default">
                <p class="title"><span class="special">| </span>Novidades</p>
                <div class="panel-body">
                    <?php foreach($new_products as $product){ ?>
                        <div class="card col-sm-6 col-md-3">
                            <div class="card-content">
                                <a href="<?=Url::to(['product/view', 'id' => $product["id"]]); ?>">
                                <?= Html::img('@web/img/'.$product['id'].'.jpg'); ?>                                                                                                                          
                                <div class="card-body">
                                    <h5 class="card-title"><?= ($product['product_name']); ?></h5>
                                    <p class="card-text description"><?= $product['description']; ?></p>
                                    <p class="card-text price"><?= $product['unit_price']; ?>€</p>
                                </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>