<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AelLiftPm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Lift Pms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-lift-pm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pm_qr_code',
            'lift_name',
            'lift_name_chi',
            'lift_id',
            'created_datetime',
            'updated_datetime',
            'is_active',
            'is_deleted',
            'client_id',
            'worker_1_id',
            'worker_2_id',
            'supervisor_id',
            'pm_schedule _start_datetime',
            'pm_schedule _end_datetime',
            'pm_actual_start_datetime',
            'pm_actual_end_datetime',
            'pm_customer signature',
            'pm_service checklist',
            'pm_status',
            'pm_reports',
            'is_canceled',
            'Cancelation reason',
            'pm_reports_chi',
            'report_status',
        ],
    ]) ?>

</div>
