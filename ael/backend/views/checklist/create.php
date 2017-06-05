<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AelServiceChecklist */

$this->title = 'Create Service Checklist';
$this->params['breadcrumbs'][] = ['label' => 'Ael Service Checklists', 'url' => ['index']];
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
