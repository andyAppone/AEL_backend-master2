<?php

namespace backend\controllers;

use Yii;
use app\models\AelMessages;
use app\models\AelMessagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MessagesController implements the CRUD actions for AelMessages model.
 */
class MessagesController extends Controller
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
     * Lists all AelMessages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AelMessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AelMessages model.
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
     * Creates a new AelMessages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AelMessages();
        $model->is_active = '1';
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
            $model->message_attach = UploadedFile::getInstance($model, 'message_attach');
            $model->message_attach_chi = UploadedFile::getInstance($model, 'message_attach_chi');
            if ($model->validate()) {
                if(isset($model->message_attach->baseName) && $model->message_attach->baseName!='') {
                    $filename = $model->message_attach->baseName.'-'.time().'.'.$model->message_attach->extension;
                    $filename2 = $model->message_attach_chi->baseName.'-'.time().'.'.$model->message_attach_chi->extension;
                    $model->message_attach->saveAs('../uploads/'.$filename);
                    $model->message_attach_chi->saveAs('../uploads/'.$filename2);

                    $model->message_attach = $filename;
                    $model->message_attach_chi = $filename2;
                }
                if(!$model->save(false)) {
                    echo "<pre>";
                    print_r($model->getErrors());
                    die;
                }
                return $this->redirect('messages');
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
     * Updates an existing AelMessages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldfile = $model->message_attach;
        $oldfile2 = $model->message_attach_chi; 
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post())) {
            $model->message_attach = UploadedFile::getInstance($model, 'message_attach');
            $model->message_attach_chi = UploadedFile::getInstance($model, 'message_attach_chi');
            if ($model->validate()) {
                $filename = $oldfile;
                $filename2 = $oldfile2;
                if(isset($model->message_attach->baseName)) {
                    $filename = $model->message_attach->baseName.'-'.time().'.'.$model->message_attach->extension;
                    $model->message_attach->saveAs('../uploads/'.$filename);
                }
                if(isset($model->message_attach_chi->baseName)) {
                    $filename2 = $model->message_attach_chi->baseName.'-'.time().'.'.$model->message_attach_chi->extension;
                    $model->message_attach_chi->saveAs('../uploads/'.$filename2);
                }
                if($filename !='') {
                    $model->message_attach = $filename;
                }
                if($filename2 !='') {
                    $model->message_attach_chi = $filename2;
                }    
                if(!$model->save(false)) {
                    echo "<pre>";
                    print_r($model->getErrors());
                    die;
                }
                return $this->redirect('messages');
            } else {
                echo "<pre>";
                print_r($model->getErrors());
                die;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AelMessages model.
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
     * Finds the AelMessages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AelMessages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AelMessages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
