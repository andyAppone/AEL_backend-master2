<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelLiftPmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-lift-pm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pm_qr_code') ?>

    <?= $form->field($model, 'lift_name') ?>

    <?= $form->field($model, 'lift_name_chi') ?>

    <?= $form->field($model, 'lift_id') ?>

    <?php // echo $form->field($model, 'created_datetime') ?>

    <?php // echo $form->field($model, 'updated_datetime') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'client_id') ?>

    <?php // echo $form->field($model, 'worker_1_id') ?>

    <?php // echo $form->field($model, 'worker_2_id') ?>

    <?php // echo $form->field($model, 'supervisor_id') ?>

    <?php // echo $form->field($model, 'pm_schedule _start_datetime') ?>

    <?php // echo $form->field($model, 'pm_schedule _end_datetime') ?>

    <?php // echo $form->field($model, 'pm_actual_start_datetime') ?>

    <?php // echo $form->field($model, 'pm_actual_end_datetime') ?>

    <?php // echo $form->field($model, 'pm_customer signature') ?>

    <?php // echo $form->field($model, 'pm_service checklist') ?>

    <?php // echo $form->field($model, 'pm_status') ?>

    <?php // echo $form->field($model, 'pm_reports') ?>

    <?php // echo $form->field($model, 'is_canceled') ?>

    <?php // echo $form->field($model, 'Cancelation reason') ?>

    <?php // echo $form->field($model, 'pm_reports_chi') ?>

    <?php // echo $form->field($model, 'report_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
