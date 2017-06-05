<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AelUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-user-view">

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
            'username',
            'auth_key',
            'password_hash',
            'password',
            'password_reset_token',
            'status',
            'email:email',
            'qr_code',
            'first_name',
            'first_name_chi',
            'last_name',
            'last_name_chi',
            'gender',
            'udid',
            'gcm',
            'created_at',
            'updated_at',
            'user_email:email',
            'user_mobile',
            'mobile_type',
            'is_active',
            'is_deleted',
            'user_type',
            'user_lat',
            'user_long',
            'designation',
            'designation_chi',
            'address',
            'address_chi',
            'supervisor_id',
        ],
    ]) ?>

</div>
