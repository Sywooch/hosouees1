<?php

namespace app\controllers;

use Yii;
use app\models\Horas;
use app\models\HorasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * HorasController implements the CRUD actions for Horas model.
 */
class HorasController extends Controller
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
     * Lists all Horas models.
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
        
        $searchModel = new HorasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $condicion);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'proyecto' => $proyecto,
        ]);
    }


    /**
     * Displays a single Horas model.
     * @param integer $IdPersona
     * @param integer $IdProyecto
     * @return mixed
     */
    public function actionView($IdPersona, $IdProyecto)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Horas #".$IdPersona, $IdProyecto,
                    'content'=>$this->renderPartial('view', [
                        'model' => $this->findModel($IdPersona, $IdProyecto),
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','IdPersona'=>$IdPersona, 'IdProyecto'=>$IdProyecto],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($IdPersona, $IdProyecto),
            ]);
        }
    }

    /**
     * Creates a new Horas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idProyecto = FALSE)
    {
        $request = Yii::$app->request;
        $model = new Horas();  
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
                    'content'=>'<span class="text-success">Registro guardaro</span>',
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Registrar mas',['create','idProyecto' => $idProyecto],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
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
                return $this->redirect(['view', 'IdPersona' => $model->IdPersona, 'IdProyecto' => $model->IdProyecto]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'idProyecto' => $idProyecto,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Horas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $IdPersona
     * @param integer $IdProyecto
     * @return mixed
     */
    public function actionUpdate($IdPersona, $IdProyecto)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($IdPersona, $IdProyecto);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Editar registro de horas sociales de <b>".$model->idPersona->NombreCompleto.'</b> en el proyecto <b>'.$model->idProyecto->NombreProyecto.'</b>',
                    'content'=>$this->renderPartial('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'true',
                    'title'=> "Registro de horas sociales de <b>".$model->idPersona->NombreCompleto.'</b> en el proyecto <b>'.$model->idProyecto->NombreProyecto.'</b>',
                    'content'=>$this->renderPartial('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update', 'IdPersona' => $model->IdPersona, 'IdProyecto' => $model->IdProyecto],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Editar registro de horas sociales de <b>".$model->idPersona->NombreCompleto.'</b> en el proyecto <b>'.$model->idProyecto->NombreProyecto.'</b>',
                    'content'=>$this->renderPartial('update', [
                        'model' => $model,
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
                return $this->redirect(['view', 'IdPersona' => $model->IdPersona, 'IdProyecto' => $model->IdProyecto]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Horas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $IdPersona
     * @param integer $IdProyecto
     * @return mixed
     */
    public function actionDelete($IdPersona, $IdProyecto)
    {
        $request = Yii::$app->request;
        $this->findModel($IdPersona, $IdProyecto)->delete();

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
     * Delete multiple existing Horas model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $IdPersona
     * @param integer $IdProyecto
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = $request->post('pks'); // Array or selected records primary keys
        foreach (Horas::findAll(json_decode($pks)) as $model) {
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
     * Finds the Horas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $IdPersona
     * @param integer $IdProyecto
     * @return Horas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IdPersona, $IdProyecto)
    {
        if (($model = Horas::findOne(['IdPersona' => $IdPersona, 'IdProyecto' => $IdProyecto])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
