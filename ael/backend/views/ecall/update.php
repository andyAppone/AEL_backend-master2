<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AelLiftPm */

$this->title = 'Update Ecall';
$this->params['breadcrumbs'][] = ['label' => 'Ael Lift Pms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cosumersData'=>$cosumersData,
        'liftData' =>$liftData,
        'supervisorData'=>$supervisorData,
        'workerData' => $workerData,
        'engineerData'=>$engineerData,
        'checklistData'=>$checklistData,
        'seelctedData'=>$seelctedData,
    ]) ?>
    </div>
</div>
