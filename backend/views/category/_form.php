<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

$subcats = Category::find()->where(['parent_id' => $model->id])->all();
if(!empty($subcats) && $model->id != null){
    $dataCategory = ['' => 'THIS CATEGORY IS A PARENT CATEGORY'];
} else {
    $dataCategory = ['' => ' '] + ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'description');
    if($model->id != '' && $model->id != null)
    {
        unset($dataCategory[$model->id]);
    }

    $all_categories = Category::find()->all();
    foreach ($all_categories as $category){
        if($category->parent_id != '' && $category->parent_id != null)
        {
            unset($dataCategory[$category->id]);

        }
    }
}?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($dataCategory,['id','description']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
