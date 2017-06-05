<?php

namespace backend\controllers;

use Yii;
use app\models\AelServiceChecklist;
use app\models\AelServiceChecklistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChecklistController implements the CRUD actions for AelServiceChecklist model.
 */
class ChecklistController extends Controller
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
     * Lists all AelServiceChecklist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelServiceChecklistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelServiceChecklist model.
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
     * Creates a new AelServiceChecklist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelServiceChecklist();
        $model->is_active = '1';
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Checklist added successfully'); 
                return $this->redirect('checklist/index');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AelServiceChecklist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Checklist updated successfully');
            return $this->redirect('checklist/index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AelServiceChecklist model.
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
     * Finds the AelServiceChecklist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelServiceChecklist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelServiceChecklist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
