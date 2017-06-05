<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AelLeave */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Leaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-leave-view">

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
            'user_id',
            'leave_start_date',
            'leave_start_time',
            'leave_end_date',
            'leave_end_time',
            'leave_desc',
            'status',
            'leave_type',
            'created_datetime',
            'updated_datetime',
            'is_active',
            'is_deleted',
            'total_leave_days',
            'action_user_id',
            'cancellation _reason',
        ],
    ]) ?>

</div>
