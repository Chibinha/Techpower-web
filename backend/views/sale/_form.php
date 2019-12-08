<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $form yii\widgets\ActiveForm */
$dataCategory = ['' => ' '] + ArrayHelper::map(\common\models\User::find()->asArray()->all(), 'id', 'username');

?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sale_date')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'total')?>

    <?= $form->field($model, 'sale_finished')->checkbox() ?>

    <?= $form->field($model, 'id_user')->dropDownList($dataCategory,['id','username']) ?>

    <?php ActiveForm::end(); ?>

</div>
