<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelCategoryDoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-category-doc-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'category_name_chi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_active')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
