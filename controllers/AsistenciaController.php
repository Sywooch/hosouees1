<?php

namespace app\controllers;

use Yii;
use app\models\Asistencia;
use app\models\AsistenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * AsistenciaController implements the CRUD actions for Asistencia model.
 */
class AsistenciaController extends Controller
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
     * Lists all Asistencia models.
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
        
        $searchModel = new AsistenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $condicion);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'proyecto' => $proyecto,
        ]);
    }


    /**
     * Displays a single Asistencia model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $idProyecto = FALSE)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Asistencia #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id, 'idProyecto'=> $idProyecto],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Asistencia model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idProyecto = FALSE)
    {
        $request = Yii::$app->request;
        $model = new Asistencia();  
        
        $this->idProyecto = $idProyecto;
                
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Agregar nuevo registro",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        'idProyecto' => $idProyecto,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Agregar nuevo registro",
                    'content'=>'<span class="text-success">Create Asistencia success</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Crear Mas',['create','idProyecto' => $idProyecto],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                ];         
            }else{           
                return [
                    'title'=> "Agregar nuevo registro",
                    'content'=>$this->renderPartial('create', [
                        'model' => $model,
                        'idProyecto' => $idProyecto,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->IdAsistencia]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'idProyecto' => $idProyecto,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Asistencia model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $idProyecto = FALSE)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);     
        $this->idProyecto = $idProyecto;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Asistencia #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                        'idProyecto' => $idProyecto,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Asistencia #".$id,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($id),
                        'idProyecto' => $idProyecto,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Asistencia #".$id,
                    'content'=>$this->renderPartial('update', [
                        'model' => $this->findModel($id),
                        'idProyecto' => $idProyecto,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->IdAsistencia]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'idProyecto' => $idProyecto,
                ]);
            }
        }
    }

    /**
     * Delete an existing Asistencia model.
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
     * Delete multiple existing Asistencia model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (Asistencia::findAll(json_decode($pks)) as $model) {
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
     * Finds the Asistencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asistencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asistencia::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
