<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
$this->title = 'Alterar Dados | TechPower';

?>
<div class="profile-update">
    <?php if (Yii::$app->session->hasFlash('message')):?>
        <div class="alert alert-success" role="alert">
            <?php echo yii::$app->session->getFlash('message');?>
        </div>
    <?php endif;?>

    <h1>Alterar Dados</h1>
    <div class="user-update-address">
        <?php
        $form = ActiveForm::begin([
            'id' => 'profile-update-form',
            'options' => ['class' => 'form-vertical'],
        ]) ?>
            <h3>Morada</h3>
            <?= $form->field($profile, 'firstName')->label('Nome') ?>
            <?= $form->field($profile, 'lastName')->label('Apelido') ?>
            <?= $form->field($profile, 'address')->label('Rua') ?>
            <?= $form->field($profile, 'city')->label('Cidade') ?>
            <?= $form->field($profile, 'postal_code')->label('Código Postal') ?>
            <?= $form->field($profile, 'country')->label('Cidade') ?>    
            <?= $form->field($profile, 'nif')->label('NIF') ?>
            <?= $form->field($profile, 'phone')->label('Telefone') ?>      

            <?= Html::submitButton('Alterar dados', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end() ?>
        <hr>
        <?= Html::submitButton('Apagar conta', ['class' => 'btn btn-danger']) ?>
    </div>
</div>
