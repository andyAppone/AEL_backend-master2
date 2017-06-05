<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelPettyCashSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ael Petty Cashes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Ael Petty Cash', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'attribute' => 'staff_id',
                'format'    => 'raw',
                'label'     => 'User',
                'value'     => function ($model) {
                    return $model['first_name'].' '.$model['last_name'];
                },
            ], 
            [
                'attribute' => 'service_type',
                'format'    => 'raw',
                'label'     => 'Service Type',
                'value'     => function ($model) {
                    if($model['service_type'] == '1') {
                        return 'PM';
                    } else if($model['service_type'] == '2') {
                        return 'Ecall';
                    } else {
                        return '';
                    }
                },
            ],
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'label'     => 'Status',
                'value'     => function ($model) {
                    if($model['status'] == '0') {
                        return 'Pending';
                    } else if($model['status'] == '1') {
                        return 'Accepted';
                    } else if($model['status'] == '2') {
                        return 'Rejected';
                    } else {
                        return '';
                    }
                },
            ],            
            [
                'attribute' => 'petty_cash_date',
                'format'    => 'raw',
                'label'     => 'Petty Cash Date',
                'value'     => function ($model) {
                    if($model['petty_cash_date']!='') {
                        return date("d F Y H:i",strtotime($model['petty_cash_date']));
                    }
                },
                'filter' => false        
            ],            
            [
                'attribute' => 'updated_at',
                'format'    => 'raw',
                'label'     => 'Updated Date',
                'value'     => function ($model) {
                    if($model['updated_datetime'] != '') {
                        return date("d F Y H:i",  strtotime($model['updated_datetime']));
                    }
                },
                'filter' => false
            ], 
            [
                    'class' => 'yii\grid\ActionColumn',
                    //'template'=>'{update}',
                    'header' => 'Action',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                                if($model['status'] == '0') {
                                    return Html::a('<button type="button" class="btn-sm btn-danger">Delete</button>', $url, [
                                                'title' => Yii::t('app', 'Delete'),
                                                'data-pjax' => "0",
                                                'data-confirm' =>"Are you sure you want to delete this item?", 
                                                'data-method'=>"post"
                                    ]);
                                } else {
                                    return '';
                                }
                        },
                        'update' => function ($url, $model) {
                                if($model['status'] == '0') {
                                    return Html::a('<button type="button" class="btn-sm btn-secondary">Edit</button>', $url, [
                                                'title' => Yii::t('app', 'Edit'),
                                    ]);
                                } else {
                                    return '';
                                }    
                                //<span class="glyphicon glyphicon-pencil"></span>
                        },
                        'view' => function ($url, $model) {
                            if($model['status'] == '0') {
                                $status = 'Inactive';
                                $statusValue = '0';
                            } else {
                                $status = 'Active';
                                $statusValue = '1';
                            }
                            if($model['status'] == '0') {
                                $url = yii\helpers\Url::to(['pettycash/changestatus', 'id' => $model['id'],'status'=>$statusValue]);
                                return Html::a('<button type="button" class="btn-sm btn-warning">'.$status.'</button>', $url, [
                                                'title' => Yii::t('app',$status),
                                    ]);
                            }
                        },
                    ],

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>    
