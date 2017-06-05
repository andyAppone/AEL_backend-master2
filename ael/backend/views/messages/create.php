<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AelMessages */

$this->title = 'Create Message';
$this->params['breadcrumbs'][] = ['label' => 'Ael Messages', 'url' => ['index']];
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
