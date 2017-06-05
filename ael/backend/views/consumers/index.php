<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Consumers', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'first_name',
                'format'    => 'raw',
                'label'     => 'Name',
                'value'     => function ($model) {
                    return $model->first_name.' '.$model->last_name;
                },
            ],
            [
                'attribute' => 'address',
                'format'    => 'raw',
                'label'     => 'Address',
                'value'     => function ($model) {
                    return $model->address;
                },
            ],
            [
                'attribute' => 'updated_at',
                'format'    => 'raw',
                'label'     => 'Updated Date',
                'value'     => function ($model) {
                    if($model->updated_at != '') {
                        return date("d F Y",$model->updated_at);
                    }
                },
            ],
            [
                'attribute' => 'username',
                'format'    => 'raw',
                'label'     => 'Username',
                'value'     => function ($model) {
                    return $model->username;
                },
            ],    
            [
                'attribute' => 'user_mobile',
                'format'    => 'raw',
                'label'     => 'Contact No',
                'value'     => function ($model) {
                    return $model->user_mobile;
                },
            ],    
            [
                'attribute' => 'email',
                'format'    => 'raw',
                'label'     => 'Email',
                'value'     => function ($model) {
                    return $model->email;
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
                            $url = yii\helpers\Url::to(['consumers/changestatus', 'id' => $model->id,'status'=>$statusValue]);
                            //$url = yii\helpers\Url::toRoute('usertype/changestatus/id='.$model->id.'/status/'.$statusValue);
                            return Html::a('<button type="button" class="btn-sm btn-warning">'.$status.'</button>', $url, [
                                            'title' => Yii::t('app',$status),
                                ]);
                        },
                    ],

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
    </div>
</div>
