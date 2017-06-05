<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AelDocuments */

$this->title = 'Update Documents';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryData' =>$categoryData
    ]) ?>
    </div>
</div>
