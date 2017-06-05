<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AelPettyCash */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Petty Cashes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-petty-cash-view">

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
            'lift_name',
            'lift_name_chi',
            'lift_id',
            'staff_id',
            'created_datetime',
            'updated_datetime',
            'is_active',
            'is_deleted',
            'service_type',
            'service_id',
            'amount_fare',
            'amount_ot',
            'amount_extra',
            'petty_cash_date',
            'status',
            'is_paid',
        ],
    ]) ?>

</div>
