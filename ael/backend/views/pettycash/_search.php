<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AelPettyCashSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-petty-cash-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class='row'>
        <div class="col-lg-4">
                <?php  echo $form->field($model, 'staff_id')->label('User'); ?>
        </div>    
        <div class="col-lg-4">
                <?= $form->field($model, 'created_datetime')->widget(
                    DatePicker::className(), [
                        //'inline' => true, 
                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'M-dd-yyyy'
                        ]
                ])->label('From Date');?>
        </div>    
        <div class="col-lg-4">
                <?= $form->field($model, 'updated_datetime')->widget(
                    DatePicker::className(), [
                        //'inline' => true, 
                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'M-dd-yyyy'
                        ]
                ])->label('To Date');?>
        </div>    
    </div>
    
    

    <?php // echo $form->field($model, 'is_active') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
