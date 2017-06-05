<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AelLift */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-lift-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lift_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lift_name_chi')->textInput(['maxlength' => true]) ?>
    <?php if(!$model->isNewRecord) { ?>
    <div class="form-group">
        <label class="control-label">QR Code</label>
        <img src="<?php echo '../assets/qrcode/'.$model->lift_qr_code.'.png'; ?>">
    </div>    
    <?php } ?>
    <?php
        $listData=ArrayHelper::map($userData,'id','first_name');
    ?>
    <?= $form->field($model, 'client_id')->dropDownList($listData, ['prompt' => '--Select Consumers--']) ?>
    <?= $form->field($model, 'lift_brand')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lift_address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lift_address_chi')->textInput(['maxlength' => true]) ?>
    <?php //echo $form->field($model, 'lift_installation_date')->textInput() ?>
    
    <?= $form->field($model, 'lift_installation_date')->widget(
        DatePicker::className(), [
            //'inline' => true, 
            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'M-dd-yyyy'
            ]
    ]);?>
    <?= $form->field($model, 'lift_lat')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'lift_long')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'is_active')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
