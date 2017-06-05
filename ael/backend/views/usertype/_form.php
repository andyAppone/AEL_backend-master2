<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelUserType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-user-type-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user_type')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_type_chi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_active')->label('Status')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    <?php if($model->isNewRecord) { ?>
        <?= $form->field($model, 'is_staff')->label('Staff')->dropDownList([ 1 => 'Yes', 0 => 'No', ]) //, ['prompt' => '--Select Status--'] ?>
    <?php } else { 
        if($model->is_staff == '1') {
            echo "Staff : Yes";
        } else {
            echo "Staff : No";
        }
    } ?>
    
    <div class="form-group">
        <br>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button('Cancel', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','onclick'=> 'document.location.href="'.Yii::$app->urlManagerBackEnd->createUrl('usertype').'" ']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
