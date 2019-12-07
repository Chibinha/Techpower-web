<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use common\widgets\Alert;
?>

<?= Alert::widget() ?>

<?php $form = ActiveForm::begin(); ?>
<h3>Alterar Password</h3>
<?= $form->field($user, 'currentPassword')->passwordInput()->label('Password Atual') ?>
<?= $form->field($user, 'newPassword')->passwordInput()->label('Nova Password') ?>
<?= $form->field($user, 'newPasswordConfirm')->passwordInput()->label('Repetir Nova Password') ?>

<div class="form-group">
    <?= Html::submitButton('Alterar Password', ['class' =>'btn btn-primary']) ?>
</div>

<?php ActiveForm::end();; ?>
