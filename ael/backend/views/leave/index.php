<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leaves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?php //echo Html::a('Create Leave', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fullname',
            [
                'attribute' => 'leave_start_date',
                'format'    => 'raw',
                'label'     => 'Start Date Time',
                'value'     => function ($model) {
                    $datetime =  $model['leave_start_date'].' '.$model['leave_start_time'];
                    return date("d F Y H:i:s",strtotime($datetime));
                },
                'filter' => false        
            ],
            [
                'attribute' => 'leave_end_date',
                'format'    => 'raw',
                'label'     => 'Start Date Time',
                'value'     => function ($model) {
                    $datetime =  $model['leave_end_date'].' '.$model['leave_end_time'];
                    return date("d F Y H:i:s",strtotime($datetime));
                },
                'filter' => false
            ],
            [
                'attribute' => 'Status',
                'format'    => 'raw',
                'label'     => 'Status',
                'value'     => function ($model) {
                    if($model['status'] == '1') {
                        return 'Approved';
                    } else if($model['status'] == '2') {
                        return 'Rejected';
                    } else if($model['status'] == '0') {
                        return 'Pending';
                    } else if(['status'] == '3') {
                        return 'Cancelled';
                    }
                },
            ],            
            [
                    'class' => 'yii\grid\ActionColumn',
                    //'template'=>'{update}',
                    'header' => 'Action',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                                return Html::a('<button type="button" class="btn-sm btn-danger">Delete</button>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            'data-pjax' => "0",
                                            'data-confirm' =>"Are you sure you want to delete this item?", 
                                            'data-method'=>"post"
                                ]);
                        },
                        'update' => function ($url, $model) {
                                return Html::a('<button type="button" class="btn-sm btn-secondary">Edit</button>', $url, [
                                            'title' => Yii::t('app', 'Edit'),
                                ]);
                                //<span class="glyphicon glyphicon-pencil"></span>
                        },
                        'view' => function ($url, $model) {
                            return '';    
                            if($model['is_active'] == '1') {
                                $status = 'Inactive';
                                $statusValue = '0';
                            } else {
                                $status = 'Active';
                                $statusValue = '1';
                            }
                            $url = yii\helpers\Url::to(['leave/changestatus', 'id' => $model['id'],'status'=>$statusValue]);
                            //$url = yii\helpers\Url::toRoute('usertype/changestatus/id='.$model->id.'/status/'.$statusValue);
                            return Html::a('<button type="button" class="btn-sm btn-warning">'.$status.'</button>', $url, [
                                            'title' => Yii::t('app',$status),
                                ]);
                        },
                    ],

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>