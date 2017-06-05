<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelMessages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-messages-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'message_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'message_title_chi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'message_desc')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'message_desc_chi')->textInput(['maxlength' => true]) ?> 
    <?= $form->field($model, 'message_attach')->fileInput(); ?>
    <br>
    <?php if(!$model->isNewRecord) { ?>
    <img src="<?php echo '../uploads/'.$model->message_attach; ?>" width="100" height="100">
    <?php } ?>
    <?= $form->field($model, 'message_attach_chi')->fileInput(); ?>
    <?php if(!$model->isNewRecord) { ?>
    <img src="<?php echo '../uploads/'.$model->message_attach_chi; ?>" width="100" height="100">
    <?php } ?>
    <?= $form->field($model, 'is_active')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    <?= $form->field($model, 'message_target_audience')->dropDownList([ 1 => 'All members', 2 => 'Consumers', 3 => 'All Staff', 4 => 'Workers', 5 => 'Engineers', 6 => 'Supervisor', ],['prompt' => '--Select Target--']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
