<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AelLiftPm */

$this->title = 'Create PM';
$this->params['breadcrumbs'][] = ['label' => 'Lift Pms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                'checklistData'=>$checklistData
        ]) ?>
    </div>
</div>
