<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelUserTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Type', ['create'], ['class' => 'btn btn-success']) ?>
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
            'user_type',
            'user_type_chi',
            [
                'attribute' => 'is_active',
                'format'    => 'raw',
                'value'     => function ($model) {
                    if($model->is_active == '1') {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                },
                'filter'=>Html::activeDropDownList($searchModel, 'is_active',array('1'=>'Active','0'=>'Inactive'),['class'=>'form-control','prompt' => '--Select Status--']),        
            ],
            /*[
                'attribute' => 'created_datetime',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return date("d F Y",strtotime($model->created_datetime));
                },
                'filter' => false,        
            ],
            [
                'attribute' => 'updated_datetime',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return date("d F Y",strtotime($model->updated_datetime));
                },
                'filter' => false,
            ],*/ 
            [
                    'class' => 'yii\grid\ActionColumn',
                    //'template'=>'{update}',
                    'header' => 'Action',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            /*if($model->id !='1' && $model->id !='2' && $model->id !='3') {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            'data-pjax' => "0",
                                            'data-confirm' =>"Are you sure you want to delete this item?", 
                                            'data-method'=>"post"
                                ]);
                            }*/
                            return '';
                        },
                        'update' => function ($url, $model) {
                                return Html::a('<button type="button" class="btn-sm btn-secondary">Edit</button>', $url, [
                                            'title' => Yii::t('app', 'Edit'),
                                ]);
                                //<span class="glyphicon glyphicon-pencil"></span>
                        },
                        'view' => function ($url, $model) {
                            if($model->is_active == '1') {
                                $status = 'Inactive';
                                $statusValue = '0';
                            } else {
                                $status = 'Active';
                                $statusValue = '1';
                            }
                            $url = yii\helpers\Url::to(['usertype/changestatus', 'id' => $model->id,'status'=>$statusValue]);
                            //$url = yii\helpers\Url::toRoute('usertype/changestatus/id='.$model->id.'/status/'.$statusValue);
                            return Html::a('<button type="button" class="btn-sm btn-warning">'.$status.'</button>', $url, [
                                            'title' => Yii::t('app',$status),
                                ]);
                        },
                    ],

            ], //
        ],
    ]); ?>
<?php Pjax::end(); ?>
    </div>
</div>
