<?php

namespace backend\controllers;

use Yii;
use app\models\AelUserType;
use app\models\AelUserTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AelusertypeController implements the CRUD actions for AelUserType model.
 */
class UsertypeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AelUserType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelUserTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelUserType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AelUserType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelUserType();
        $model->is_active = '1';
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->save()) { 
                echo "<pre>";
                print_r($model->getErrors());
                die;
            } else {
                \Yii::$app->getSession()->setFlash('success', 'User type added successfully');
                return $this->redirect('usertype/index');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AelUserType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(!$model->save()) {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            } else {
                \Yii::$app->getSession()->setFlash('success', 'User type updated successfully');
                return $this->redirect('usertype/index');
            }    
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AelUserType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionChangestatus() {
        $id = Yii::$app->request->get('id');
        $status = Yii::$app->request->get('status');
        $model = $this->findModel($id);
        $model->is_active = $status;
        $model->save();
        \Yii::$app->getSession()->setFlash('success', 'Status updated successfully');
        return $this->redirect(['index']);
    }

    /**
     * Finds the AelUserType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelUserType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelUserType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
