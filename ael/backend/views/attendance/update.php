<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AelDailyAttendance */

$this->title = 'Update Ael Daily Attendance: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ael Daily Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ael-daily-attendance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
