<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'qr_code') ?>

    <?php // echo $form->field($model, 'first_name') ?>

    <?php // echo $form->field($model, 'first_name_chi') ?>

    <?php // echo $form->field($model, 'last_name') ?>

    <?php // echo $form->field($model, 'last_name_chi') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'udid') ?>

    <?php // echo $form->field($model, 'gcm') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'user_mobile') ?>

    <?php // echo $form->field($model, 'mobile_type') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'user_type') ?>

    <?php // echo $form->field($model, 'user_lat') ?>

    <?php // echo $form->field($model, 'user_long') ?>

    <?php // echo $form->field($model, 'designation') ?>

    <?php // echo $form->field($model, 'designation_chi') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'address_chi') ?>

    <?php // echo $form->field($model, 'supervisor_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
