<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $form yii\widgets\ActiveForm */
$user =  User::find()->where(['id' => $model->id_user])->One();
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sale_date')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-m-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'total')->textInput(['readonly'=> true])?>

    <?= $form->field($model, 'sale_finished')->checkbox() ?>

    <?= $form->field($user, 'username')->textInput(['readonly'=> true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
