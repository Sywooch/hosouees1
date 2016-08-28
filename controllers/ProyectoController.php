<?php

namespace app\controllers;

use Yii;
use app\modules\catalogs\models\Proyecto;
use app\modules\catalogs\models\ProyectoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use \yii\web\Response;
use yii\helpers\Html;
use app\helpers\PersonaHelper;
use app\helpers\EmailHelper;

/**
 * ProyectoController implements the CRUD actions for Proyecto model.
 */
class ProyectoController extends Controller
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
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionConsulta()
    {    
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['EstadoRegistro' => '1', 'IdEstadoProyecto'=> '1']);

        return $this->render('consulta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }    
    
   /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionReservarCupo($id)
    {    
        $persona = PersonaHelper::getPersona();
        $model = $this->findModel($id);
        if($model->getPersonaActivaProyecto($persona->IdPersona) > 0)
        {
            $view ='cupo_reservado';
        }
        elseif($model->getCuposDisponibles() > 0)
        {
            $view ='reservar_cupo';
        }
        else
        {
            $view ='cupos_agotados';
        }
           
        return $this->renderAjax($view, [
            'model' => $model,
            'persona' =>$persona
        ]);
    } 
    
  /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionGuardarReservaCupo($IdProyecto, $IdPersona)
    {    
        $persona = PersonaHelper::getPersona();
        $model = $this->findModel($IdProyecto);
        if($model->getCuposDisponibles() > 0)
        {
            $cupo = new \app\models\Horas();
            $cupo->IdPersona = $IdPersona;
            $cupo->IdProyecto = $IdProyecto;
            $cupo->EstadoRegistro = '1';
            $cupo->PersonaActiva = '1';
            $cupo->HorasRealizadas = 0;
            $cupo->save();              
            
            EmailHelper::sendEmailReservaCupo($model, $persona);
            $view = 'cupo_reservado';
        }
        else
        {
            $view = 'cupos_agotados';
        }
        
        return $this->renderAjax($view, [
            'model' => $model,
            'persona' =>$persona
        ]);        
    }    
    
   /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionConsultaAsesor()
    {    
        $persona = PersonaHelper::getPersona();
        $searchModel = new ProyectoSearch();

        $condicion = (\Yii::$app->user->can('VerTodosProyectos')) ? ['EstadoRegistro' => '1'] : ['EstadoRegistro' => '1', 'IdPersonaAsesor'=> $persona->IdPersona];
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $condicion);

        return $this->render('consulta_asesor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }       
    
   /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionConsultaEstudiante()
    {    
        $persona = PersonaHelper::getPersona();
        
        $searchModel = new ProyectoSearch();

        $condicion = "IdProyecto IN (SELECT IdProyecto FROM horas WHERE IdPersona = $persona->IdPersona AND EstadoRegistro ='1')";
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $condicion);

        return $this->render('consulta_estudiante', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }          
    
    /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionDetalleAsesor($id)
    {    
        $persona = PersonaHelper::getPersona();
        $model = $this->findModel($id);
           
        return $this->renderAjax('detalle_asesor', [
            'model' => $model,
            'persona' =>$persona
        ]);
    }    
    
    /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionDetalleEstudiante($id)
    {    
        $persona = PersonaHelper::getPersona();
        $model = $this->findModel($id);
           
        return $this->renderAjax('detalle_estudiante', [
            'model' => $model,
            'persona' =>$persona
        ]);
    }    
        
    
    /**
     * Displays a single Proyecto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Proyecto #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
//                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
//                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
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
    public function actionCreate()
    {
        $model = new Proyecto();

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
                return $this->redirect(['/catalogs/proyecto', 'id' => $model->IdProyecto]);
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
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
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
                return $this->redirect(['/catalogs/proyecto', 'id' => $model->IdProyecto]);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Deletes an existing Proyecto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
