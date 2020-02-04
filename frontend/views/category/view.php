<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->description . ' | TechPower';
?>                 
<div class="category-view">
    <?php if ($sub_categories) {?>
        <p>Filtrar por:</p>
        <?php foreach($sub_categories as $sub_category){?>
            <?= Html::a($sub_category['description'], ['category/view', 'id' => $sub_category['id']], ['class' => 'btn btn-success']) ?>
        <?php }
    } ?>
    <div class="body-content">
        <div class="row">
            <div class="panel panel-default">
                <p class="title"><span class="special">| </span><?= Html::encode($model->description) ?></p>
                <div class="panel-body">
                    <?php foreach($products as $product){ ?>
                    <div class="card col-sm-6 col-md-3">
                        <div class="card-content">
                            <a href="<?=Url::to(['product/view', 'id' => $product["id"]]); ?>">
                            <?= Html::img('@web/images/' . $product['product_image'], ['class'=>'card-img-top']); ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['product_name'] ?></h5>
                                <p class="card-text description"><?= $product['description']?></p>
                                <p class="card-text price"><?= $product['unit_price'] ?>€</p>
                            </div>
                            </a>
                        </div>
                    </div>
                    <?php } ?>                 
                </div>
                <div class="pagination center">
                    <?php echo LinkPager::widget(['pagination' => $pages,]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
