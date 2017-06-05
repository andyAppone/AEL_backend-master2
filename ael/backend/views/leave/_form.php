<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AelLeave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-leave-form">

    <?php $form = ActiveForm::begin(); 
    $clientlistData = ArrayHelper::map($userData,'id','label'); 
    ?>

    <?php echo $form->field($model, 'user_id')->label('User')->widget(Select2::classname(), [
        'data' => $clientlistData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a User ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    
    <?php 
    $model->leave_start_date = $model->leave_start_date.' '.$model->leave_start_time;
    echo $form->field($model, 'leave_start_date')->widget(DateTimePicker::className(), [
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
    
    <?php 
    $model->leave_end_date = $model->leave_end_date.' '.$model->leave_end_time;
    echo $form->field($model, 'leave_end_date')->widget(DateTimePicker::className(), [
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

    <?= $form->field($model, 'status')->dropDownList([ 1 => 'Approved', 2 => 'Rejected', 0 => 'Pending', 3 => 'Cancelled', ], ['prompt' => '--Select Status--']) ?>
    <?= $form->field($model, 'leave_type')->dropDownList([ '0' => 'Annual Leave', '1' => 'Sick Leave','2'=>'Others' ], ['prompt' => '--Select Type--']) ?>
    <?= $form->field($model, 'is_active')->label('Status')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    <?= $form->field($model, 'total_leave_days')->textInput() ?>
    <?= $form->field($model, 'cancellation_reason')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
