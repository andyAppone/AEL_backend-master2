<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AelUser */

$this->title = 'Update Consumers';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userTypeData'=>$userTypeData,
        'supervisorData' => $supervisorData
    ]); ?>
    </div>
</div>
