<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelDailyAttendance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-daily-attendance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'clock_In')->textInput() ?>

    <?= $form->field($model, 'clock_Out')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 1 => '1', 2 => '2', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'leave_id')->textInput() ?>

    <?= $form->field($model, 'created_datetime')->textInput() ?>

    <?= $form->field($model, 'updated_datetime')->textInput() ?>

    <?= $form->field($model, 'is_active')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_deleted')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
