<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "formularios".
 *
 * @property integer $IdFormulario
 * @property string $NombreFormulario
 * @property string $Reglamentos
 * @property string $DescripcionFormulario
 * @property string $ArchivoAdjunto
 * @property string $NombreAdjunto
 * @property string $EstadoRegistro
 */
class Formularios extends \yii\db\ActiveRecord
{
    public $image;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'formularios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png, pdf, doc, docx, xls, txt'], 
            [['NombreFormulario', 'DescripcionFormulario'], 'required'],
            [['NombreFormulario', 'ArchivoAdjunto', 'NombreAdjunto'], 'string', 'max' => 150],
            [['Reglamentos', 'DescripcionFormulario'], 'string', 'max' => 500],
            [['EstadoRegistro'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image' => Yii::t('app', 'Archivo adjunto'),
            'IdFormulario' => Yii::t('app', 'Id Formulario'),
            'NombreFormulario' => Yii::t('app', 'Nombre Formulario'),
            'Reglamentos' => Yii::t('app', 'Reglamentos'),
            'DescripcionFormulario' => Yii::t('app', 'Descripcion Formulario'),
            'ArchivoAdjunto' => Yii::t('app', 'Archivo Adjunto'),
            'NombreAdjunto' => Yii::t('app', 'Nombre Adjunto'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @inheritdoc
     * @return FormulariosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormulariosQuery(get_called_class());
    }
    
    /**
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile() 
    {
        return isset($this->ArchivoAdjunto) ? Yii::$app->params['uploadPath'] . $this->ArchivoAdjunto : null;
    }    
    
    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() 
    {
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->ArchivoAdjunto) ? $this->ArchivoAdjunto : 'default_user.jpg';
        return Yii::$app->params['uploadUrl'] . $avatar;
    }    
    
    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        $this->NombreAdjunto = $image->name;
        $ext = pathinfo($image->name, PATHINFO_EXTENSION);

        // generate a unique file name
        $this->ArchivoAdjunto = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }   
    
    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->ArchivoAdjunto = null;
        $this->NombreAdjunto = null;

        return true;
    }        
}
