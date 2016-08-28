<?php

namespace app\modules\catalogs\models;

use Yii;
use yii\web\UploadedFile;
use app\models\Horas;
use app\models\Asistencia;
use app\models\Comunicacion;
/**
 * This is the model class for table "persona".
 *
 * @property integer $IdPersona
 * @property string $Nombres
 * @property string $Apellidos
 * @property string $CarnetEstudiante
 * @property string $CarnetEmpleado
 * @property string $DUI
 * @property string $NIT
 * @property string $Direccion
 * @property string $Telefono
 * @property string $Sexo
 * @property string $Cargo
 * @property integer $UserId
 * @property string $TipoPersona
 * @property integer $IdCarrera
 * @property string $Elegible
 * @property string $ArchivoAdjunto
 * @property string $NombreAdjunto
 * @property string $EstadoRegistro
 * @property Asistencia[] $asistencias
 * @property Comunicacion[] $comunicacions
 * @property Comunicacion[] $comunicacions0
 * @property Horas[] $horas
 * @property Proyecto[] $idProyectos
 * @property UserAccounts $user
 * @property Carrera $idCarrera
 * @property Proyecto[] $proyectos
 */
class Persona extends \yii\db\ActiveRecord
{
    public $image;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],              
            [['Nombres', 'Apellidos', 'Sexo'], 'required'],
            [['UserId', 'IdCarrera'], 'integer'],
            [['Nombres', 'Apellidos', 'CarnetEstudiante', 'CarnetEmpleado'], 'string', 'max' => 100],
            [['DUI'], 'string', 'max' => 10],
            [['Direccion'], 'string', 'max' => 500],
            [['NIT'], 'string', 'max' => 17],
            [['Telefono'], 'string', 'max' => 8],
            [['Sexo', 'EstadoRegistro', 'Elegible'], 'string', 'max' => 1],
            [['Cargo'], 'string', 'max' => 25],
            [['TipoPersona'], 'string', 'max' => 2],
            [['ArchivoAdjunto', 'NombreAdjunto'], 'string', 'max' => 150],
            ['UserId', 'unique', 'message'=>'Este usuario ya ha sido utilizado para otra persona'],
            [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['UserId' => 'id']],
            [['IdCarrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['IdCarrera' => 'IdCarrera']],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image' => Yii::t('app', 'Fotografía'),
            'IdPersona' => Yii::t('app', 'Id Persona'),
            'Nombres' => Yii::t('app', 'Nombres'),
            'Apellidos' => Yii::t('app', 'Apellidos'),
            'CarnetEstudiante' => Yii::t('app', 'Carnet Estudiante'),
            'CarnetEmpleado' => Yii::t('app', 'Carnet Empleado'),
            'DUI' => Yii::t('app', 'Dui'),
            'NIT' => Yii::t('app', 'Nit'),
            'Direccion' => Yii::t('app', 'Direccion'),
            'Telefono' => Yii::t('app', 'Telefono'),
            'Sexo' => Yii::t('app', 'Sexo'),
            'Cargo' => Yii::t('app', 'Cargo'),
            'UserId' => Yii::t('app', 'Usuario'),
            'TipoPersona' => Yii::t('app', 'Tipo Persona'),
            'IdCarrera' => Yii::t('app', 'Id Carrera'),
            'ArchivoAdjunto' => Yii::t('app', 'Archivo Adjunto'),
            'NombreAdjunto' => Yii::t('app', 'Nombre Adjunto'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
            'Elegible' => Yii::t('app', 'Es elegible para horas sociales'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsistencias()
    {
        return $this->hasMany(Asistencia::className(), ['IdPersona' => 'IdPersona'])->inverseOf('idPersona');
    }    
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunicacions()
    {
        return $this->hasMany(Comunicacion::className(), ['IdPersonaRemitente' => 'IdPersona'])->inverseOf('idPersonaRemitente');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunicacions0()
    {
        return $this->hasMany(Comunicacion::className(), ['IdPersonaReceptor' => 'IdPersona'])->inverseOf('idPersonaReceptor');
    }    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoras()
    {
        return $this->hasMany(Horas::className(), ['IdPersona' => 'IdPersona'])->inverseOf('idPersona');
    }
    
    /**
     * Obtiene la cantidad de horas sociales acumuladas por el estudiante en todos sus proyectos
     */
    public function getCantidadHorasSociales()
    {
        return $this->getHoras()->where(['EstadoRegistro'=>'1'])->sum('HorasRealizadas');
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['IdProyecto' => 'IdProyecto'])->viaTable('horas', ['IdPersona' => 'IdPersona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'UserId'])->inverseOf('personas');
    }    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarrera()
    {
        return $this->hasOne(Carrera::className(), ['IdCarrera' => 'IdCarrera'])->inverseOf('personas');
    }    
    
    /**
     * @return \yii\db\ActiveQuery  obtiene los proyectos de los caules la persona es asesor
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['IdPersonaAsesor' => 'IdPersona'])->inverseOf('idPersonaAsesor');
    }    
    
    public function getNombreCompleto()
    {
        return $this->Nombres.' '.$this->Apellidos;
    }      
         
    
    /**
     * @inheritdoc
     * @return PersonaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonaQuery(get_called_class());
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
