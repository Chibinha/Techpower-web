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

    <?= $form->field($perfil, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($perfil, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($perfil, 'nif')->textInput() ?>

    <?= $form->field($perfil, 'postal_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($perfil, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($perfil, 'country')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
