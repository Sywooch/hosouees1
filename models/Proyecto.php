<?php

namespace app\models;

use Yii;

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
 * @property Persona $idPersonaAsesor
 */
class Proyecto extends \yii\db\ActiveRecord
{
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
            'IdProyecto' => Yii::t('app', 'Id Proyecto'),
            'NombreProyecto' => Yii::t('app', 'Nombre Proyecto'),
            'HorasSolicitadas' => Yii::t('app', 'Horas Solicitadas'),
            'HorasSocialesXhora' => Yii::t('app', 'Horas Sociales Xhora'),
            'Ubicacion' => Yii::t('app', 'Ubicacion'),
            'FechaIni' => Yii::t('app', 'Fecha Ini'),
            'FechaFin' => Yii::t('app', 'Fecha Fin'),
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
    public function getAsistencias()
    {
        return $this->hasMany(Asistencia::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('idProyecto');
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
    public function getHoras()
    {
        return $this->hasMany(Horas::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('idProyecto');
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
}
