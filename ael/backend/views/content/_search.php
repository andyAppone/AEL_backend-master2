<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelStaticContentManagementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-static-content-management-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content_title') ?>

    <?= $form->field($model, 'content_title_chi') ?>

    <?= $form->field($model, 'content_desc') ?>

    <?= $form->field($model, 'content_desc_chi') ?>

    <?php // echo $form->field($model, 'content_attach') ?>

    <?php // echo $form->field($model, 'content_attach_chi') ?>

    <?php // echo $form->field($model, 'created_datetime') ?>

    <?php // echo $form->field($model, 'updated_datetime') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
