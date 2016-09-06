<?php

namespace app\controllers;

use Yii;
use app\modules\catalogs\models\Persona;
use app\modules\catalogs\models\PersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\helpers\Html;

/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class EstudianteController extends Controller
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
     * Lists all Persona models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Persona model.
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
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Persona();
        $model->scenario = Persona::SCENARIO_ESTUDIANTE;
        
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
                return $this->redirect(['/catalogs/estudiante', 'id' => $model->IdPersona]);
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
     * Updates an existing Persona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Persona::SCENARIO_ESTUDIANTE;
        
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
                return $this->redirect(['/catalogs/estudiante', 'id' => $model->IdPersona]);
            } else {
                // error in saving model
            }
        }
        return $this->render('update', [
            'model'=>$model,
        ]);
    }
    
    /*
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatePerfil($id)
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
                return $this->redirect(['/']);
            } else {
                // error in saving model
            }
        }
        return $this->render('update_perfil', [
            'model'=>$model,
        ]);
    }    

    /**
     * Deletes an existing Persona model.
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
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGenerarReporte()
    {
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,'ES');

        return $this->render('generar-reporte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReporteIframe($idPersona){
        return $this->renderPartial('generar-reporte-iframe', [
            'idPersona' => $idPersona,
        ]);        
    }
    
    public function actionReporte($idPersona) {
        $estudiante = Persona::findOne(['IdPersona' => $idPersona]);
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reporte',[
            'estudiante' => $estudiante
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // Letter paper format
            'format' => Pdf::FORMAT_LETTER, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Reporte de horas sociales de '.$estudiante->NombreCompleto],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Reporte de horas sociales de '.$estudiante->NombreCompleto.' al '.date('d-m-Y').Html::img('@web/img/logo.png', ['width'=>'25px', 'height' =>'25px', 'align'=>'center', 'class'=> ''])], 
                'SetFooter'=>['Página {PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }    
    
    public function actionReporteProyecto($idPersona, $idProyecto) {
        $estudiante = Persona::findOne(['IdPersona' => $idPersona]);
        $horas= $estudiante->getHoras()->where(['EstadoRegistro' => '1', 'IdProyecto' => $idProyecto])->one();
        $p = $horas->idProyecto;        
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_reporte_proyecto',[
            'estudiante' => $estudiante,
            'idProyecto' => $idProyecto,
            'horas' => $horas,
            'p' => $p,
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // Letter paper format
            'format' => Pdf::FORMAT_LETTER, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Reporte de horas sociales de '.$estudiante->NombreCompleto],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Reporte de horas sociales de '.$estudiante->NombreCompleto.' en el proyecto '.$p->NombreProyecto.' al '.date('d-m-Y').Html::img('@web/img/logo.png', ['width'=>'25px', 'height' =>'25px', 'align'=>'center', 'class'=> ''])], 
                'SetFooter'=>['Página {PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }        
    
}
