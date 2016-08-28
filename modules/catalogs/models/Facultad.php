<?php

namespace app\modules\catalogs\models;

use Yii;

/**
 * This is the model class for table "facultad".
 *
 * @property integer $IdFacultad
 * @property string $Nombre
 * @property string $Descripcion
 * @property string $NombreCorto
 * @property integer $IdUniversidad
 * @property string $EstadoRegistro
 *
 * @property Carrera[] $carreras
 * @property Universidad $idUniversidad
 * @property Proyecto $idUniversidad0
 */
class Facultad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facultad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'NombreCorto'], 'required'],
            [['IdUniversidad'], 'integer'],
            [['Nombre', 'Descripcion'], 'string', 'max' => 100],
            [['NombreCorto'], 'string', 'max' => 10],
            [['EstadoRegistro'], 'string', 'max' => 1],
            [['IdUniversidad'], 'exist', 'skipOnError' => true, 'targetClass' => Universidad::className(), 'targetAttribute' => ['IdUniversidad' => 'IdUniversidad']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdFacultad' => Yii::t('app', 'Id Facultad'),
            'Nombre' => Yii::t('app', 'Nombre de facultad'),
            'Descripcion' => Yii::t('app', 'Descripcion'),
            'NombreCorto' => Yii::t('app', 'Nombre Corto'),
            'IdUniversidad' => Yii::t('app', 'Universidad'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarreras()
    {
        return $this->hasMany(Carrera::className(), ['IdFacultad' => 'IdFacultad'])->inverseOf('idFacultad');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUniversidad()
    {
        return $this->hasOne(Universidad::className(), ['IdUniversidad' => 'IdUniversidad'])->inverseOf('facultads');
    }


    /**
     * @inheritdoc
     * @return FacultadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacultadQuery(get_called_class());
    }  
}
