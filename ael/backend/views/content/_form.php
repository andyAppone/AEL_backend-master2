<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\AelStaticContentManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-static-content-management-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_title_chi')->textInput(['maxlength' => true]) ?>


    
    <?= $form->field($model, 'content_desc')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    
    <?= $form->field($model, 'content_desc_chi')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    


    <?= $form->field($model, 'content_attach')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_attach_chi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_datetime')->textInput() ?>

    <?= $form->field($model, 'updated_datetime')->textInput() ?>

    <?= $form->field($model, 'is_active')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_deleted')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
