<?php
namespace app\modules\catalogs\models;
use Yii;
use yii\web\UploadedFile;
use app\models\Comunicacion;
use app\models\Horas;
use app\models\Asistencia;
/**
 * This is the model class for table "proyecto".
 *
 * @property integer $IdProyecto
 * @property string $NombreProyecto
 * @property integer $HorasSolicitadas
 * @property double $HorasSocialesXhora
 * @property string $Ubicacion
 * @property string $FechaIni
 * @property string $FechaFin
 * @property integer $IdInstitucion
 * @property integer $IdEstadoProyecto
 * @property integer $IdPersonaAsesor
 * @property integer $NumeroPersonas
 * @property string $ArchivoAdjunto
 * @property string $NombreAdjunto
 * @property string $EstadoRegistro
 * 
 * @property Asistencia[] $asistencias
 * @property Comunicacion[] $comunicacions
 * @property Horas[] $horas
 * @property Persona[] $idPersonas
 * @property EstadosProyecto $idEstadoProyecto
 * @property Institucion $idInstitucion
 */
class Proyecto extends \yii\db\ActiveRecord
{
    public $image;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],            
            [['NombreProyecto', 'Ubicacion', 'IdInstitucion', 'IdEstadoProyecto'], 'required'],
            [['HorasSolicitadas', 'IdInstitucion', 'IdEstadoProyecto', 'IdPersonaAsesor', 'NumeroPersonas'], 'integer'],
            [['HorasSocialesXhora'], 'number'],
            [['FechaIni', 'FechaFin'], 'safe'],
            [['NombreProyecto', 'Ubicacion', 'ArchivoAdjunto', 'NombreAdjunto'], 'string', 'max' => 150],
            [['EstadoRegistro'], 'string', 'max' => 1],
            [['IdEstadoProyecto'], 'exist', 'skipOnError' => true, 'targetClass' => EstadosProyecto::className(), 'targetAttribute' => ['IdEstadoProyecto' => 'IdEstadoProyecto']],
            [['IdInstitucion'], 'exist', 'skipOnError' => true, 'targetClass' => Institucion::className(), 'targetAttribute' => ['IdInstitucion' => 'IdInstitucion']],
            [['IdPersonaAsesor'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['IdPersonaAsesor' => 'IdPersona']],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image' => Yii::t('app', 'Fotografía'),
            'IdProyecto' => Yii::t('app', 'Id Proyecto'),
            'NombreProyecto' => Yii::t('app', 'Nombre Proyecto'),
            'HorasSolicitadas' => Yii::t('app', 'Horas Solicitadas'),
            'HorasSocialesXhora' => Yii::t('app', 'Horas Sociales Xhora'),
            'Ubicacion' => Yii::t('app', 'Ubicacion'),
            'FechaIni' => Yii::t('app', 'Fecha Inicio'),
            'FechaFin' => Yii::t('app', 'Fecha Finalización'),
            'IdInstitucion' => Yii::t('app', 'Id Institucion'),
            'IdEstadoProyecto' => Yii::t('app', 'Id Estado Proyecto'),
            'IdPersonaAsesor' => Yii::t('app', 'Id Persona Asesor'),
            'NumeroPersonas' => Yii::t('app', 'Numero Personas'),
            'ArchivoAdjunto' => Yii::t('app', 'Archivo Adjunto'),
            'NombreAdjunto' => Yii::t('app', 'Nombre Adjunto'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunicacions()
    {
        return $this->hasMany(Comunicacion::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('idProyecto');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsistencias()
    {
        return $this->hasMany(Asistencia::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('idProyecto');
    }    
    
    /**
     * @return \yii\db\ActiveRecord
     */
    public function getAsistenciasPersona($IdPersona)
    {
        return $this->getAsistencias()->where(['IdPersona' => $IdPersona, 'EstadoRegistro' => '1'])->orderBy('Fecha')->all();
    }      
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoras()
    {
        return $this->hasMany(Horas::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('idProyecto');
    }
    
    /**
     */
    public function getHorasIdPersona($idPersona)
    {
        return $this->getHoras()->where(['IdPersona' => $idPersona, 'EstadoRegistro' =>'1'])->one();
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonas()
    {
        return $this->hasMany(Persona::className(), ['IdPersona' => 'IdPersona'])->viaTable('horas', ['IdProyecto' => 'IdProyecto']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonasActivas()
    {
        return $this->hasMany(Persona::className(), ['IdPersona' => 'IdPersona'])->viaTable('horas', ['IdProyecto' => 'IdProyecto'],function ($query) {
            /* @var $query \yii\db\ActiveQuery */
            $query->andWhere(['PersonaActiva' => '1']);
        });
    }      
    
    public function getPersonaActivaProyecto($IdPersona)
    {
        return $this->getIdPersonas()->where(['IdPersona' => $IdPersona])->count();
    }    
    
    public function getCuposUtilizados()
    {
       return $this->getIdPersonasActivas()->count();
    }    
    
    public function getCuposDisponibles()
    {
        $cupos = $this->NumeroPersonas - $this->getIdPersonasActivas()->count();
        return $cupos;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstadoProyecto()
    {
        return $this->hasOne(EstadosProyecto::className(), ['IdEstadoProyecto' => 'IdEstadoProyecto'])->inverseOf('proyectos');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdInstitucion()
    {
        return $this->hasOne(Institucion::className(), ['IdInstitucion' => 'IdInstitucion'])->inverseOf('proyectos');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonaAsesor()
    {
        return $this->hasOne(Persona::className(), ['IdPersona' => 'IdPersonaAsesor'])->inverseOf('proyectos');
    }
    
    
    /**
     * @inheritdoc
     * @return ProyectoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProyectoQuery(get_called_class());
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