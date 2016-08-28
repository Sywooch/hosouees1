<?php

namespace app\models;

use Yii;
use \app\modules\catalogs\models\Persona;
use \app\modules\catalogs\models\Proyecto;
use \app\modules\catalogs\models\UserAccounts;
use app\components\HorasAlumnoValidator;
use app\components\AlumnoProyectoValidator;
/**
 * This is the model class for table "horas".
 *
 * @property integer $IdPersona
 * @property integer $IdProyecto
 * @property integer $HorasRealizadas
 * @property integer $HorasRestantes
 * @property string $ProyectoCompleto 
 * @property string $ProyectosRealizados
 * @property string $PersonaActiva
 * @property integer $IdUsuarioRegistro 
 * @property string $EstadoRegistro
 *
 * @property Persona $idPersona
 * @property Proyecto $idProyecto
 * @property UserAccounts $idUsuarioRegistro 
 */
class Horas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'horas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdPersona', 'IdProyecto', 'HorasRealizadas'], 'required'],
            ['HorasRealizadas', HorasAlumnoValidator::className()],
            ['IdPersona', AlumnoProyectoValidator::className()],
//            [['IdPersona', 'IdProyecto'], 'unique', 'message'=> 'El estudiante ya esta registrado en este proyecto', 'targetAttribute' => ['IdPersona']],
            [['IdPersona', 'IdProyecto', 'HorasRealizadas', 'HorasRestantes', 'IdUsuarioRegistro'], 'integer'],
            [['ProyectoCompleto', 'PersonaActiva', 'EstadoRegistro'], 'string', 'max' => 1],
            [['ProyectosRealizados'], 'string', 'max' => 150],
            [['IdPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['IdPersona' => 'IdPersona']],
            [['IdProyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['IdProyecto' => 'IdProyecto']],
	    [['IdUsuarioRegistro'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['IdUsuarioRegistro' => 'id']], 
        ];
    }  

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdPersona' => Yii::t('app', 'Id Persona'),
            'IdProyecto' => Yii::t('app', 'Id Proyecto'),
            'HorasRealizadas' => Yii::t('app', 'Horas Realizadas'),
            'HorasRestantes' => Yii::t('app', 'Horas Restantes'),
            'ProyectoCompleto' => Yii::t('app', 'Proyecto Completo'), 
            'ProyectosRealizados' => Yii::t('app', 'Proyectos Realizados'),
            'PersonaActiva' => Yii::t('app', 'Persona Activa'),
            'IdUsuarioRegistro' => Yii::t('app', 'Id Usuario Registro'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersona()
    {
        return $this->hasOne(Persona::className(), ['IdPersona' => 'IdPersona'])->inverseOf('horas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('horas');
    }

	   /**
    * @return \yii\db\ActiveQuery 
    */ 
   public function getIdUsuarioRegistro() 
   { 
       return $this->hasOne(UserAccounts::className(), ['id' => 'IdUsuarioRegistro'])->inverseOf('horas'); 
   }     
    
    /**
     * @inheritdoc
     * @return HorasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HorasQuery(get_called_class());
    }
}
