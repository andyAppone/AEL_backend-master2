<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\AelPettyCash */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-petty-cash-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'amount_fare')->textInput() ?>
    <?= $form->field($model, 'amount_ot')->textInput() ?>
    <?= $form->field($model, 'amount_extra')->textInput() ?>
    <?php echo $form->field($model, 'petty_cash_date')->widget(DateTimePicker::className(), [
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
                ])->label('Petty Cash Date');?>
    <?= $form->field($model, 'status')->dropDownList([ 1 => 'Accepted', 0 => 'Pending', 2 => 'Rejected', ], ['prompt' => '--Select Status--']) ?>
    <?= $form->field($model, 'is_paid')->dropDownList([ 1 => 'Paid', 0 => 'Unpaid', ], ['prompt' => '--Select Paid Status--']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
