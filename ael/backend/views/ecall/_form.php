<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use dosamigos\datepicker\DatePicker;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use kartik\select2\Select2;
//use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AelLiftPm */
/* @var $form yii\widgets\ActiveForm */
?>
<!--<link href="/ael/backend/web/assets/1dabc7ba/themes/smoothness/jquery-ui.css" rel="stylesheet">-->
<!--<link href="/ael/backend/web/assets/8b47bbbe/css/bootstrap-datetimepicker.css" rel="stylesheet">-->

<!--<link href="/ael/backend/web/assets/52034e1f/css/select2.css" rel="stylesheet">
<link href="/ael/backend/web/assets/52034e1f/css/select2-addl.css" rel="stylesheet">
<link href="/ael/backend/web/assets/52034e1f/css/select2-krajee.css" rel="stylesheet">

<script type="text/javascript">var s2options_d6851687 = {"themeCss":".select2-container--krajee","sizeCss":"","doReset":true,"doToggle":false,"doOrder":false};
window.select2_004bfd32 = {"allowClear":true,"theme":"krajee","width":"100%","placeholder":"Select a Client ...","language":"en"};
</script>-->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

<div class="ael-lift-pm-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php 
    $clientlistData = ArrayHelper::map($cosumersData,'id','label'); 
    $liftData = ArrayHelper::map($liftData,'id','label');
    $supervisorData = ArrayHelper::map($supervisorData,'id','label');
    $workerData  = ArrayHelper::map($workerData,'id','label');
    $engineerData  = ArrayHelper::map($engineerData,'id','label');
    $checklistData  = ArrayHelper::map($checklistData,'id','label');
    
    ?>
    <?php echo $form->field($model, 'client_id')->widget(Select2::classname(), [
        'data' => $clientlistData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Client ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?php echo $form->field($model, 'lift_id')->widget(Select2::classname(), [
        'data' => $liftData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Lift ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?php if(!$model->isNewRecord) { ?>
    <div class="form-group">
        <label class="control-label">QR Code</label>
        <img src="<?php echo '../assets/qrcode/'.$model->ecall_qr_code.'.png'; ?>">
    </div>    
    <?php } ?>
    
    <?php echo $form->field($model, 'ecall_launch_datetime')->widget(DateTimePicker::className(), [
        'language' => 'en',
        'size' => 'ms',
        'template' => '{input}',
        'pickButtonIcon' => 'glyphicon glyphicon-time',
        'clientOptions' => [
            'autoclose' => true,
            'linkFormat' => 'dd MM yyyy - HH:ii P', // if inline = true
            // 'format' => 'HH:ii P', // if inline = false
            //'todayBtn' => true
        ]
    ]);?>
    
    <?php echo $form->field($model, 'supervisor_id')->widget(Select2::classname(), [
        'data' => $supervisorData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Supervisor ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?php echo $form->field($model, 'worker_1_id')->widget(Select2::classname(), [
        'data' => $workerData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Worker ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?php echo $form->field($model, 'worker_2_id')->widget(Select2::classname(), [
        'data' => $engineerData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Engineer ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?php echo $form->field($model, 'ecall_service_checklist')->widget(Select2::classname(), [
        'data' => $checklistData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Checklist ...','multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true,
        ],
    ]);
    ?>
    
    <?= $form->field($model, 'ecall_status')->dropDownList([ '1' => 'Pending', '2' => 'Accepted','3' => 'Need response','4' => 'Completed successfully','5' => 'Work in progress','6' => 'Need follow up', ], ['prompt' => '--Select Status--']); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
