<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */

$dataCategory = ArrayHelper::map(\common\models\Category::find()->asArray()->all(), 'id', 'description');
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_price')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => '11'])?>

    <?= $form->field($model, 'product_image')->fileInput()?>
   
    <?= $form->field($model, 'id_category')->dropDownList($dataCategory,['id','description']) ?>
    
    <?= $form->field($model, 'is_discontinued')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
