<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AelLift */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Lifts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-lift-view">

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
            'created_datetime',
            'updated_datetime',
            'is_active',
            'is_deleted',
            'client_id',
            'last_pm_details',
            'lift_qr_code',
            'lift_brand',
            'lift_address',
            'lift_address_chi',
            'lift_installation_date',
            'lift_lat',
            'lift_long',
        ],
    ]) ?>

</div>
