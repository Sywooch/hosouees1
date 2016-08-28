<?php

namespace app\models;

use Yii;
use app\modules\catalogs\models\Proyecto;
use app\modules\catalogs\models\Persona;
use app\modules\catalogs\models\UserAccounts;
/**
 * This is the model class for table "asistencia".
 *
 * @property integer $IdAsistencia
 * @property integer $IdProyecto
 * @property integer $IdPersona
 * @property string $Fecha
 * @property string $HoraEntrada
 * @property string $HoraSalida
 * @property double $CantidadHoras
 * @property string $Comentarios
 * @property integer $IdUsuarioRegistro
 * @property string $EstadoRegistro
 *
 * @property Proyecto $idProyecto
 * @property Persona $idPersona
 * @property UserAccounts $idUsuarioRegistro
 */
class Asistencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asistencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IdProyecto', 'IdPersona', 'Fecha', 'HoraEntrada', 'HoraSalida', 'CantidadHoras', 'IdUsuarioRegistro'], 'required'],
            [['IdProyecto', 'IdPersona', 'IdUsuarioRegistro'], 'integer'],
            [['Fecha', 'HoraEntrada', 'HoraSalida'], 'safe'],
            [['CantidadHoras'], 'number'],
            [['Comentarios'], 'string', 'max' => 250],
            [['EstadoRegistro'], 'string', 'max' => 1],
            [['IdProyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['IdProyecto' => 'IdProyecto']],
            [['IdPersona'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['IdPersona' => 'IdPersona']],
            [['IdUsuarioRegistro'], 'exist', 'skipOnError' => true, 'targetClass' => UserAccounts::className(), 'targetAttribute' => ['IdUsuarioRegistro' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdAsistencia' => Yii::t('app', 'Id Asistencia'),
            'IdProyecto' => Yii::t('app', 'Id Proyecto'),
            'IdPersona' => Yii::t('app', 'Id Persona'),
            'Fecha' => Yii::t('app', 'Fecha'),
            'HoraEntrada' => Yii::t('app', 'Hora Entrada'),
            'HoraSalida' => Yii::t('app', 'Hora Salida'),
            'CantidadHoras' => Yii::t('app', 'Cantidad Horas'),
            'Comentarios' => Yii::t('app', 'Comentarios'),
            'IdUsuarioRegistro' => Yii::t('app', 'Id Usuario Registro'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto()
    {
        return $this->hasOne(Proyecto::className(), ['IdProyecto' => 'IdProyecto'])->inverseOf('asistencias');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersona()
    {
        return $this->hasOne(Persona::className(), ['IdPersona' => 'IdPersona'])->inverseOf('asistencias');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuarioRegistro()
    {
        return $this->hasOne(UserAccounts::className(), ['id' => 'IdUsuarioRegistro'])->inverseOf('asistencias');
    }

    /**
     * @inheritdoc
     * @return AsistenciaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsistenciaQuery(get_called_class());
    }
}
