<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AelDocumentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-documents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'doc_title') ?>

    <?= $form->field($model, 'doc_title_chi') ?>

    <?= $form->field($model, 'doc_desc') ?>

    <?= $form->field($model, 'doc_desc_chi') ?>

    <?php // echo $form->field($model, 'doc_attach') ?>

    <?php // echo $form->field($model, 'doc_attach_chi') ?>

    <?php // echo $form->field($model, 'created_datetime') ?>

    <?php // echo $form->field($model, 'updated_datetime') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'doc_category') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
