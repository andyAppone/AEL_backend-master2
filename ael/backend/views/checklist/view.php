<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AelServiceChecklist */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Service Checklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-service-checklist-view">

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
            'lift_checklist_details',
            'lift_checklist_details_chi',
            'created_datetime',
            'updated_datetime',
            'is_active',
            'is_deleted',
            'lift_checklist_type',
            'lift_checklist_expected_result',
        ],
    ]) ?>

</div>
