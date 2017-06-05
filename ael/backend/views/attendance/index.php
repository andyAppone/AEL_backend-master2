<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelDailyAttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Attendances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Ael Daily Attendance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            'clock_In',
            'clock_Out',
            // 'status',
            // 'leave_id',
            // 'created_datetime',
            // 'updated_datetime',
            // 'is_active',
            // 'is_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>    
