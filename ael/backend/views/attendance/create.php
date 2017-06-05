<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AelDailyAttendance */

$this->title = 'Create Ael Daily Attendance';
$this->params['breadcrumbs'][] = ['label' => 'Ael Daily Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ael-daily-attendance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
