<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelServiceChecklist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-service-checklist-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'lift_checklist_details')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lift_checklist_details_chi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lift_checklist_type')->dropDownList(['P' => 'PM','E' => 'E-call'], ['prompt' => '--Select Type--']) ?>
    <?= $form->field($model, 'lift_checklist_expected_result')->dropDownList([ 'Y' => 'Yes', 'N' => 'No', ], ['prompt' => '--Select Result--']) ?>
    <?= $form->field($model, 'is_active')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
