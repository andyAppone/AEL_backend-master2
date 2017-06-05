<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .help-block-error {
        color : white !important;
    }
    label {
        color:white;
    }
</style>
<div class="site-login">
    <div style="padding-left: 160px;">
        <img src="../../backend/web/loginimage.png" style=" text-align: center;width: 61px;">
    </div>   
    <br>    
    <div class="row" style="padding-left:106px;">
        <div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'Username','style'=>'background:none;border:white 1px solid;width:215px;color:white'])->label(false); ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password','style'=>'background:none;border:white 1px solid;width:215px;color:white'])->label(false); ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button','style'=>'width:215px;background:white;color:grey;font-weight:bold;']) ?>
                </div>
                <br>
                
            <?php ActiveForm::end(); ?>
        </div>
        
    </div>
    <div style="color:white;width: 100%;padding-left:40px;"><?php echo date("Y"); ?>&copy;Appone Esolution Limited - All right reserved</div>
</div>
