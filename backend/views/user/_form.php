<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php if ($role) { ?>
        <?= Html::a('Revoke Worker role', ['/user/revokeworker?id=' . $model->id], ['class'=>'btn btn-primary']) ?>
    <?php } else { ?>
        <?= Html::a('Assign Worker role', ['/user/assignworker?id=' . $model->id], ['class'=>'btn btn-primary']) ?>
    <?php } ?>

</div>
