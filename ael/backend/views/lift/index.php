<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelLiftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lifts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lift', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php if(Yii::$app->session->getFlash('success')!='') { ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success'); ?>
    </div>
    <?php } ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'No.',],
            'lift_name',
            'lift_address',
            [
                'attribute' => 'updated_datetime',
                'format'    => 'raw',
                'label'     => 'Updated Date',
                'value'     => function ($model) {
                    if($model['updated_datetime'] != '') {
                        return date("d F Y",strtotime($model['updated_datetime']));
                    }
                },
                'filter' => false
            ],
            [
                'attribute' => 'first_name',
                'format'    => 'raw',
                'label'     => 'Client Name',
                'value'     => function ($model) {
                    return $model['first_name'];
                },
            ],            
            [
                'attribute' => 'lift_installation_date',
                'format'    => 'raw',
                'label'     => 'Installation Date',
                'value'     => function ($model) {
                    if($model['lift_installation_date'] != '') {
                        return date("d F Y",strtotime($model['lift_installation_date']));
                    }
                },
                'filter' => false
            ],            
            // 'is_active',
            // 'is_deleted',
            // 'client_id',
            // 'last_pm_details',
            // 'lift_qr_code',
            // 'lift_brand',
            // 'lift_address',
            // 'lift_address_chi',
            // 'lift_installation_date',
            // 'lift_lat',
            // 'lift_long',

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
                            if($model['is_active'] == '1') {
                                $status = 'Inactive';
                                $statusValue = '0';
                            } else {
                                $status = 'Active';
                                $statusValue = '1';
                            }
                            $url = yii\helpers\Url::to(['lift/changestatus', 'id' => $model['id'],'status'=>$statusValue]);
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
