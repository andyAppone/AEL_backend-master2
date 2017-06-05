<?php

namespace backend\controllers;

use Yii;
use app\models\AelDocuments;
use app\models\AelDocumentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocumentsController implements the CRUD actions for AelDocuments model.
 */
class DocumentsController extends Controller
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
     * Lists all AelDocuments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelDocumentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelDocuments model.
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
     * Creates a new AelDocuments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelDocuments();
        $model->scenario = 'create';
        $modelDoc = new \app\models\AelCategoryDoc();
        $categoryData = $modelDoc->find()->select('category_name as label,id')->asArray()->all();
        $model->is_active = '1';
        if ($model->load(Yii::$app->request->post())) {
            $model->doc_attach = UploadedFile::getInstance($model, 'doc_attach');
            $model->doc_attach_chi = UploadedFile::getInstance($model, 'doc_attach_chi');
            if ($model->validate()) {
            $filename = $model->doc_attach->baseName.'-'.time().'.'.$model->doc_attach->extension;
                $filename2 = $model->doc_attach_chi->baseName.'-'.time().'.'.$model->doc_attach_chi->extension;
                $model->doc_attach->saveAs('../uploads/docs/'.$filename);
                $model->doc_attach_chi->saveAs('../uploads/docs/'.$filename2);

                $model->doc_attach = $filename;
                $model->doc_attach_chi = $filename2;
                if(!$model->save(false)) {
                    echo "<pre>";
                    print_r($model->getErrors());
                    die;
                }
                return $this->redirect('documents');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'categoryData' =>$categoryData
            ]);
        }
    }

    /**
     * Updates an existing AelDocuments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        $modelDoc = new \app\models\AelCategoryDoc();
        $categoryData = $modelDoc->find()->select('category_name as label,id')->asArray()->all();
        $oldfile = $model->doc_attach;
        $oldfile2 = $model->doc_attach_chi; 
        
        if($model->load(Yii::$app->request->post())) {
            $model->doc_attach = UploadedFile::getInstance($model, 'doc_attach');
            $model->doc_attach_chi = UploadedFile::getInstance($model, 'doc_attach_chi');
            if ($model->validate()) {
                $filename = $oldfile;
                $filename2 = $oldfile2;
                if(isset($model->doc_attach->baseName)) {
                    $filename = $model->doc_attach->baseName.'-'.time().'.'.$model->doc_attach->extension;
                    $model->doc_attach->saveAs('../uploads/docs/'.$filename);
                }
                if(isset($model->doc_attach_chi->baseName)) {
                    $filename2 = $model->doc_attach_chi->baseName.'-'.time().'.'.$model->doc_attach_chi->extension;
                    $model->doc_attach_chi->saveAs('../uploads/docs/'.$filename2);
                }
                if($filename !='') {
                    $model->doc_attach = $filename;
                }
                if($filename2 !='') {
                    $model->doc_attach_chi = $filename2;
                }
                if(!$model->save(false)) {
                    echo "<pre>";
                    print_r($model->getErrors());
                    die;
                }
                return $this->redirect('documents');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'categoryData' =>$categoryData
            ]);
        }
    }

    /**
     * Deletes an existing AelDocuments model.
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
     * Finds the AelDocuments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelDocuments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelDocuments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
