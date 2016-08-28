<?php

namespace app\models;

use Yii;
use app\modules\catalogs\models\Proyecto;
use app\modules\catalogs\models\Persona;
use app\modules\catalogs\models\UserAccounts;
use yii\web\UploadedFile;
/**
 * This is the model class for table "comunicacion".
 *
 * @property integer $IdComunicacion
 * @property integer $IdPersonaRemitente
 * @property integer $IdPersonaReceptor
 * @property integer $Sujeto
 * @property string $Comentarios
 * @property string $FechaHora
 * @property string $NombreAdjunto1
 * @property string $RutaAdjunto1
 * @property string $NombreAdjunto2
 * @property string $RutaAdjunto2
 * @property integer $IdProyecto
 * @property integer $IdUsuarioRegistro
 * @property string $EstadoRegistro
 *
 * @property UserAccounts $idUsuarioRegistro
 * @property Persona $idPersonaRemitente
 * @property Persona $idPersonaReceptor
 * @property Proyecto $idProyecto
 */
class Comunicacion extends \yii\db\ActiveRecord
{
    public $image1;
    public $image2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comunicacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image1','image2'], 'safe'],
            [['image1', 'image2'], 'file', 'extensions'=>'jpg, gif, png, pdf, doc, docx, xls, txt'],                 
            [['IdPersonaRemitente', 'Comentarios', 'IdProyecto', 'IdUsuarioRegistro'], 'required'],
            [['IdPersonaRemitente', 'IdPersonaReceptor', 'IdProyecto', 'IdUsuarioRegistro'], 'integer'],
            [['FechaHora'], 'safe'],
            [['Comentarios'], 'string', 'max' => 500],
            [['NombreAdjunto1', 'RutaAdjunto1', 'NombreAdjunto2', 'RutaAdjunto2', 'Sujeto'], 'string', 'max' => 150],
            [['EstadoRegistro'], 'string', 'max' => 1],
            [['IdUsuarioRegistro'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['IdUsuarioRegistro' => 'id']],
            [['IdPersonaRemitente'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['IdPersonaRemitente' => 'IdPersona']],
            [['IdPersonaReceptor'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['IdPersonaReceptor' => 'IdPersona']],
            [['IdProyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['IdProyecto' => 'IdProyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdComunicacion' => Yii::t('app', 'Id Comunicacion'),
            'IdPersonaRemitente' => Yii::t('app', 'Id Persona Remitente'),
            'IdPersonaReceptor' => Yii::t('app', 'Id Persona Receptor'),
            'Sujeto' => Yii::t('app', 'Sujeto del mensaje'),
            'Comentarios' => Yii::t('app', 'Comentarios'),
            'FechaHora' => Yii::t('app', 'Fecha Hora'),
            'NombreAdjunto1' => Yii::t('app', 'Nombre Adjunto1'),
            'RutaAdjunto1' => Yii::t('app', 'Ruta Adjunto1'),
            'NombreAdjunto2' => Yii::t('app', 'Nombre Adjunto2'),
            'RutaAdjunto2' => Yii::t('app', 'Ruta Adjunto2'),
            'IdProyecto' => Yii::t('app', 'Id Proyecto'),
            'IdUsuarioRegistro' => Yii::t('app', 'Id Usuario Registro'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarioRegistro()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'IdUsuarioRegistro'])->inverseOf('comunicacions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonaRemitente()
    {
        return $this->hasOne(Persona::className(), ['IdPersona' => 'IdPersonaRemitente'])->inverseOf('comunicacions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonaReceptor()
    {
        return $this->hasOne(Persona::className(), ['IdPersona' => 'IdPersonaReceptor'])->inverseOf('comunicacions0');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('comunicacions');
    }

    /**
     * @inheritdoc
     * @return ComunicacionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComunicacionQuery(get_called_class());
    }
    
   /**
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile($n) 
    {
        $rutaAdjunto = 'RutaAdjunto'.$n;        
        return isset($this->$rutaAdjunto) ? Yii::$app->params['uploadPath'] . $this->$rutaAdjunto : null;
    }    
    
    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl($n) 
    {
        $rutaAdjunto = 'RutaAdjunto'.$n;
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->$rutaAdjunto) ? $this->$rutaAdjunto : 'default_user.jpg';
        return Yii::$app->params['uploadUrl'] . $avatar;
    }    
    
    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage($n) {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image'.$n);
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }
        
        $nombreAdjunto = 'NombreAdjunto'.$n;
        $rutaAdjunto = 'RutaAdjunto'.$n;
        // store the source file name
        $this->$nombreAdjunto = $image->name;
        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
        // generate a unique file name
        $this->$rutaAdjunto = Yii::$app->security->generateRandomString().".{$ext}";
        // the uploaded image instance
        return $image;
    }   
    
    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage($n) {
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
        $nombreAdjunto = 'NombreAdjunto'.$n;
        $rutaAdjunto = 'RutaAdjunto'.$n;
        
        $this->$rutaAdjunto = null;
        $this->$nombreAdjunto = null;
        return true;
    }        
}
