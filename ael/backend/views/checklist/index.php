<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelServiceChecklistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Checklists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Service Checklist', ['create'], ['class' => 'btn btn-success']) ?>
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
            'lift_checklist_details',
            //'lift_checklist_details_chi',
            // 'is_active',
            // 'is_deleted',
            // 'lift_checklist_type',
            // 'lift_checklist_expected_result',
            [
                'attribute' => 'lift_checklist_type',
                'format'    => 'raw',
                'value'     => function ($model) {
                    if($model->lift_checklist_type == 'P') {
                        return 'PM';
                    } else if($model->lift_checklist_type == 'E') {
                        return 'E-Call';
                    }
                },
                'filter'=>Html::activeDropDownList($searchModel, 'lift_checklist_type',array('P'=>'PM','E'=>'E-Call'),['class'=>'form-control','prompt' => '--Select Type--']),        
            ],
            [
                'attribute' => 'updated_at',
                'format'    => 'raw',
                'label'     => 'Updated Date',
                'value'     => function ($model) {
                    if($model->updated_datetime != '') {
                        return date("d F Y H:i",  strtotime($model->updated_datetime));
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
                            if($model->is_active == '1') {
                                $status = 'Inactive';
                                $statusValue = '0';
                            } else {
                                $status = 'Active';
                                $statusValue = '1';
                            }
                            $url = yii\helpers\Url::to(['checklist/changestatus', 'id' => $model->id,'status'=>$statusValue]);
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
