<?php

namespace app\modules\catalogs\models;

use Yii;

/**
 * This is the model class for table "universidad".
 *
 * @property integer $IdUniversidad
 * @property string $Nombre
 * @property string $NombreCorto
 * @property string $Mision
 * @property string $Vision
 * @property string $CorreoElectronico
 * @property string $Telefono
 * @property string $Direccion
 * @property string $Url
 * @property string $Logo
 * @property string $EstadoRegistro
 *
 * @property Facultad[] $facultads
 */
class Universidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'universidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'NombreCorto'], 'required'],
            [['Nombre'], 'string', 'max' => 100],
            [['NombreCorto', 'Telefono'], 'string', 'max' => 10],
            [['Mision', 'Vision'], 'string', 'max' => 1000],
            [['CorreoElectronico'], 'string', 'max' => 45],
            [['Direccion'], 'string', 'max' => 500],
            [['Url', 'Logo'], 'string', 'max' => 250],
            [['EstadoRegistro'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdUniversidad' => Yii::t('app', 'Id Universidad'),
            'Nombre' => Yii::t('app', 'Nombre'),
            'NombreCorto' => Yii::t('app', 'Nombre Corto'),
            'Mision' => Yii::t('app', 'Mision'),
            'Vision' => Yii::t('app', 'Vision'),
            'CorreoElectronico' => Yii::t('app', 'Correo Electronico'),
            'Telefono' => Yii::t('app', 'Telefono'),
            'Direccion' => Yii::t('app', 'Direccion'),
            'Url' => Yii::t('app', 'Url'),
            'Logo' => Yii::t('app', 'Logo'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacultads()
    {
        return $this->hasMany(Facultad::className(), ['IdUniversidad' => 'IdUniversidad'])->inverseOf('idUniversidad');
    }

    /**
     * @inheritdoc
     * @return UniversidadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UniversidadQuery(get_called_class());
    }
}
