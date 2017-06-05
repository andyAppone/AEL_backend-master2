<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AelDocuments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ael-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doc_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'doc_title_chi')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'doc_desc')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'doc_desc_chi')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'doc_attach')->fileInput(); ?>
    <?php if(!$model->isNewRecord) { ?>
    <a href="<?php echo '../uploads/docs/'.$model->doc_attach; ?>" target="blank">View</a>
    <?php } ?>
    <?= $form->field($model, 'doc_attach_chi')->fileInput(); ?>
    <?php if(!$model->isNewRecord) { ?>
    <a href="<?php echo '../uploads/docs/'.$model->doc_attach_chi; ?>" target="blank">View</a>
    <?php } ?>
    
    <?= $form->field($model, 'is_active')->dropDownList([ 1 => 'Active', 0 => 'Inactive', ], ['prompt' => '--Select Status--']) ?>
    
    <?php 
    $categoryData = ArrayHelper::map($categoryData,'id','label'); 
    ?>
    <?php echo $form->field($model, 'doc_category')->widget(Select2::classname(), [
        'data' => $categoryData,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Category ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
