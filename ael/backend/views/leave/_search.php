<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelLeaveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-leave-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'leave_start_date') ?>

    <?= $form->field($model, 'leave_start_time') ?>

    <?= $form->field($model, 'leave_end_date') ?>

    <?php // echo $form->field($model, 'leave_end_time') ?>

    <?php // echo $form->field($model, 'leave_desc') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'leave_type') ?>

    <?php // echo $form->field($model, 'created_datetime') ?>

    <?php // echo $form->field($model, 'updated_datetime') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'total_leave_days') ?>

    <?php // echo $form->field($model, 'action_user_id') ?>

    <?php // echo $form->field($model, 'cancellation _reason') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
