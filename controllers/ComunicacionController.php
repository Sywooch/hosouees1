<?php

namespace app\controllers;

use Yii;
use app\models\Comunicacion;
use app\models\ComunicacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ComunicacionController implements the CRUD actions for Comunicacion model.
 */
class ComunicacionController extends Controller
{
    public $idProyecto;
    
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
     * Lists all Comunicacion models.
     * @return mixed
     */
    public function actionIndex($idProyecto = FALSE)
    {    
        $this->layout = 'void';
        $this->idProyecto = $idProyecto;
        $proyecto = \app\modules\catalogs\models\Proyecto::findOne(['IdProyecto' => $idProyecto]);
        if(! isset($proyecto))
        {
            die('Proyecto no existente');
        }
        
        $condicion = ($idProyecto !== FALSE) ? ['IdProyecto' => $idProyecto] : FALSE;        
        
        $searchModel = new ComunicacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $condicion);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'proyecto' => $proyecto,
        ]);
    }


    /**
     * Displays a single Comunicacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Comunicacion #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
//                            .Html::a('Edit',['Editar','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idProyecto)
    {
        $this->layout = 'void';
        $model = new Comunicacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
//            $image = UploadedFile::getInstance($model, 'image');
            $image1 = $model->uploadImage('1');
            $image2 = $model->uploadImage('2');
            
            if($model->save()){
                if ($image1 !== false) {
                    $path = $model->getImageFile('1');
                    $image1->saveAs($path);
                }
               if ($image2 !== false) {
                    $path = $model->getImageFile('2');
                    $image2->saveAs($path);
                }                
                return $this->redirect(['/comunicacion', 'idProyecto' => $idProyecto]);
            } else {
                // error in saving model
            }            
            
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'idProyecto' => $idProyecto,
            ]);
        }
    }

    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFile = $model->getImageFile();
        $oldAvatar1 = $model->ArchivoAdjunto1;
        $oldFileName1 = $model->NombreAdjunto1;
        $oldAvatar2 = $model->ArchivoAdjunto2;
        $oldFileName2 = $model->NombreAdjunto2;

        if ($model->load(Yii::$app->request->post())) {
            // process uploaded image file instance
            $image1 = $model->uploadImage('1');
            $image2 = $model->uploadImage('2');

            // revert back if no valid file instance uploaded
            if ($image1 === false) {
                $model->ArchivoAdjunto1 = $oldAvatar1;
                $model->NombreAdjunto1 = $oldFileName1;
            }
            
            if ($image2 === false) {
                $model->ArchivoAdjunto2 = $oldAvatar2;
                $model->NombreAdjunto2 = $oldFileName2;
            }            

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image1 !== false && unlink($oldFile1)) { // delete old and overwrite
                    $path = $model->getImageFile('1');
                    $image1->saveAs($path);
                }
                if ($image2 !== false && unlink($oldFile2)) { // delete old and overwrite
                    $path = $model->getImageFile('2');
                    $image2->saveAs($path);
                } 
                
                return $this->redirect(['/comunicacion', 'id' => $model->IdProyecto]);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Delete an existing Comunicacion model.
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
     * Delete multiple existing Comunicacion model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (Comunicacion::findAll(json_decode($pks)) as $model) {
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
     * Finds the Comunicacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comunicacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comunicacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
