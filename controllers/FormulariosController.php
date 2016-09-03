<?php

namespace app\controllers;

use Yii;
use app\models\Formularios;
use app\models\FormulariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * FormulariosController implements the CRUD actions for Formularios model.
 */
class FormulariosController extends Controller
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
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Formularios models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new FormulariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Formularios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Formulario #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary'/*,'role'=>'modal-remote'*/])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Formularios model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Formularios();  

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
//            $image = UploadedFile::getInstance($model, 'image');
            $image = $model->uploadImage();
            
            if($model->save()){
                if ($image !== false) {
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['/formularios']);
            } else {
                // error in saving model
            }            
            
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
       
    }

    /**
     * Updates an existing Formularios model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFile = $model->getImageFile();
        $oldAvatar = $model->ArchivoAdjunto;
        $oldFileName = $model->NombreAdjunto;


        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image = $model->uploadImage();

            // revert back if no valid file instance uploaded
            if ($image === false) {
                $model->ArchivoAdjunto = $oldAvatar;
                $model->NombreAdjunto = $oldFileName;
            }

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false) { // delete old and overwrite
                    if(file_exists($oldFile))
                    {
                        unlink($oldFile);
                    }
                    
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['/formularios']);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Delete an existing Formularios model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true];    
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Formularios model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (Formularios::findAll(json_decode($pks)) as $model) {
            $model->delete();
        }
        

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>true]; 
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Formularios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Formularios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Formularios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDescarga()
    {
        $forms = Formularios::findAll(['EstadoRegistro' => '1']);
        
        return $this->render('descarga', [
           'forms' => $forms,
        ]);       
    }
}
