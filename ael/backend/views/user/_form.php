<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AelUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'first_name_chi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'last_name_chi')->textInput(['maxlength' => true]) ?>
    
    <?php if(!$model->isNewRecord) { ?>
    <div class="form-group">
        <label class="control-label">QR Code</label>
        <img src="<?php echo '../assets/qrcode/'.$model->qr_code.'.png'; ?>">
    </div>    
    <?php } ?>
    
    <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'Male', 'F' => 'Female', ], ['prompt' => '--Select Gender--']) ?>
    <?php if($model->isNewRecord) { ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true,'disabled'=>'']) ?>
    <?php } ?>
    <?php if($model->isNewRecord) { ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true,'disabled'=>'']) ?>
    <?php } ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'user_mobile')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address_chi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_active')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    <?php
        $listData=ArrayHelper::map($userTypeData,'id','user_type');
        $supervisorData=ArrayHelper::map($supervisorData,'id','first_name');
    ?>
    <?= $form->field($model, 'user_type')->dropDownList($listData, ['prompt' => '--Select Type--']) ?>
    <div id="supervisorid" <?php if($model->user_type == '1' || $model->user_type == '') { ?> style="display:none;" <?php } ?> >
            <?= $form->field($model, 'supervisor_id')->dropDownList($supervisorData, ['prompt' => '--Select Supervisor--']) ?>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
$this->registerJs("
    $('#aeluser-user_type').on('change', function() { 
        if($(this).val() == '2' || $(this).val() == '3') {
            $('#supervisorid').show();
        } else {
            $('#supervisorid').hide();
        }
    });
");
?>