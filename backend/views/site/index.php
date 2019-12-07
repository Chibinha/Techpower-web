<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'Menu BackOffice';
?>
<div class="site-index">

    <div class="titulo-menu">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

      <div class="body-content">
      <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    </div>
</div>
