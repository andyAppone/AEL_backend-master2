<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelServiceChecklistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-service-checklist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lift_checklist_details') ?>

    <?= $form->field($model, 'lift_checklist_details_chi') ?>

    <?= $form->field($model, 'created_datetime') ?>

    <?= $form->field($model, 'updated_datetime') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'lift_checklist_type') ?>

    <?php // echo $form->field($model, 'lift_checklist_expected_result') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
