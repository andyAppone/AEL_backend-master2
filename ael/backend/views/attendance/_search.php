<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\AelDailyAttendanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-daily-attendance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'date')->label('User'); ?>
        </div>    
        <div class="col-md-4">
            <?php echo $form->field($model, 'clock_In')->widget(DateTimePicker::className(), [
                        'language' => 'en',
                        'size' => 'ms',
                        'template' => '{input}',
                        'pickButtonIcon' => 'glyphicon glyphicon-time',
                        'clientOptions' => [
                            'autoclose' => true,
                            'linkFormat' => 'dd MM yyyy - HH:ii P', // if inline = true
                            // 'format' => 'HH:ii P', // if inline = false
                            'todayBtn' => true
                        ]
                ])->label('From Date');?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'clock_Out')->widget(DateTimePicker::className(), [
                        'language' => 'en',
                        'size' => 'ms',
                        'template' => '{input}',
                        'pickButtonIcon' => 'glyphicon glyphicon-time',
                        'clientOptions' => [
                            'autoclose' => true,
                            'linkFormat' => 'dd MM yyyy - HH:ii P', // if inline = true
                            // 'format' => 'HH:ii P', // if inline = false
                            'todayBtn' => true
                        ]
                ])->label('To Date');?>
        </div>    
    </div>    

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
