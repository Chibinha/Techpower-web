<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SaleItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'id_product')->textInput() ?>

    <?= $form->field($model, 'id_sale')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
