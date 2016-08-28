<?php

namespace app\controllers;

use Yii;
use app\modules\catalogs\models\Persona;
use app\modules\catalogs\models\PersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
}
