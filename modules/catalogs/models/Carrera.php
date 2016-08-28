<?php

namespace app\modules\catalogs\models;

use Yii;

/**
 * This is the model class for table "carrera".
 *
 * @property integer $IdCarrera
 * @property string $Nombre
 * @property string $NombreCorto
 * @property integer $IdFacultad
 * @property string $EstadoRegistro
 *
 * @property Facultad $idFacultad
 * @property Persona[] $personas
 */
class Carrera extends \yii\db\ActiveRecord
{
    public $IdUniversidad;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrera';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre'], 'required'],
            [['IdFacultad'], 'integer'],
            [['Nombre', 'NombreCorto'], 'string', 'max' => 100],
            [['EstadoRegistro'], 'string', 'max' => 1],
            [['IdFacultad'], 'exist', 'skipOnError' => true, 'targetClass' => Facultad::className(), 'targetAttribute' => ['IdFacultad' => 'IdFacultad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdCarrera' => Yii::t('app', 'Id Carrera'),
            'Nombre' => Yii::t('app', 'Nombre'),
            'NombreCorto' => Yii::t('app', 'Nombre Corto'),
            'IdFacultad' => Yii::t('app', 'Facultad'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFacultad()
    {
        return $this->hasOne(Facultad::className(), ['IdFacultad' => 'IdFacultad'])->inverseOf('carreras');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['IdCarrera' => 'IdCarrera'])->inverseOf('idCarrera');
    }

    /**
     * @inheritdoc
     * @return CarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarreraQuery(get_called_class());
    }
}
