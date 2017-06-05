<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AelStaticContentManagement */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Static Content Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-static-content-management-view">

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
            'content_title',
            'content_title_chi',
            'content_desc',
            'content_desc_chi',
            'content_attach',
            'content_attach_chi',
            'created_datetime',
            'updated_datetime',
            'is_active',
            'is_deleted',
        ],
    ]) ?>

</div>
