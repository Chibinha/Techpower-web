<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\User */

?>
<div class="user-update">

    <h1>Alterar Dados</h1>
    <div class="user-update-address">
        <?php
        $form = ActiveForm::begin([
            'id' => 'user-update-form',
            'options' => ['class' => 'form-horizontal'],
        ]) ?>
            <h3>Morada</h3>
            <?= $form->field($profile, 'address') ?>
            <?= $form->field($profile, 'city') ?>
            <?= $form->field($profile, 'postal_code') ?>
            <?= $form->field($profile, 'country') ?>    
            <?= $form->field($profile, 'nif') ?>
            <?= $form->field($profile, 'phone') ?>      
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
    </div>
    
    <div class="user-update-password">
        <?php
        $form = ActiveForm::begin([
            'id' => 'user-update-form',
            'options' => ['class' => 'form-horizontal'],
        ]) ?>
            <h3>Alterar Password</h3>
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>  
    </div>
</div>
