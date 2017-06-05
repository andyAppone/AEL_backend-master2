<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelLiftSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-lift-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lift_name') ?>

    <?= $form->field($model, 'lift_name_chi') ?>

    <?= $form->field($model, 'created_datetime') ?>

    <?= $form->field($model, 'updated_datetime') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'client_id') ?>

    <?php // echo $form->field($model, 'last_pm_details') ?>

    <?php // echo $form->field($model, 'lift_qr_code') ?>

    <?php // echo $form->field($model, 'lift_brand') ?>

    <?php // echo $form->field($model, 'lift_address') ?>

    <?php // echo $form->field($model, 'lift_address_chi') ?>

    <?php // echo $form->field($model, 'lift_installation_date') ?>

    <?php // echo $form->field($model, 'lift_lat') ?>

    <?php // echo $form->field($model, 'lift_long') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
