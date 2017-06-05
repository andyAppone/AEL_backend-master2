<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AelPettyCash */

$this->title = 'Create Ael Petty Cash';
$this->params['breadcrumbs'][] = ['label' => 'Ael Petty Cashes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-petty-cash-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
