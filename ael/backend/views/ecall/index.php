<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AelLiftPmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ecall Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-content-wrapper">
    <div class="page-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ecall', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'No.',],
            'lift_name',
            [
                'attribute' => 'first_name',
                'format'    => 'raw',
                'label'     => 'Client',
                'value'     => function ($model) {
                    return $model['client'];
                },
            ],
            'supervisor',
            'worker',
            'enginner',
            [
                'attribute' => 'ecall_launch_datetime',
                'format'    => 'raw',
                'label'     => 'Issue Date',
                'value'     => function ($model) {
                    if($model['ecall_launch_datetime'] != '') {
                        return date("d F Y H:i",strtotime($model['ecall_launch_datetime']));
                    }
                },
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
                            $url = yii\helpers\Url::to(['ecall/changestatus', 'id' => $model['id'],'status'=>$statusValue]);
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
