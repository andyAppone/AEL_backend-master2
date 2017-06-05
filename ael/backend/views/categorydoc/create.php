<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AelCategoryDoc */

$this->title = 'Create Category Doc';
$this->params['breadcrumbs'][] = ['label' => 'Category Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
