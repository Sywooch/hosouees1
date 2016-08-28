<?php

namespace app\modules\catalogs\models;

use Yii;

/**
 * This is the model class for table "institucion".
 *
 * @property integer $IdInstitucion
 * @property string $Nombre
 * @property string $Siglas
 * @property string $SitioWeb
 * @property string $EstadoRegistro
 *
 * @property Proyecto[] $proyectos
 */
class Institucion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'institucion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre'], 'required'],
            [['Nombre'], 'string', 'max' => 50],
            [['Siglas'], 'string', 'max' => 15],
            [['SitioWeb'], 'string', 'max' => 45],
            [['EstadoRegistro'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdInstitucion' => Yii::t('app', 'Id Institucion'),
            'Nombre' => Yii::t('app', 'Nombre'),
            'Siglas' => Yii::t('app', 'Siglas'),
            'SitioWeb' => Yii::t('app', 'Sitio Web'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['IdInstitucion' => 'IdInstitucion'])->inverseOf('idInstitucion');
    }

    /**
     * @inheritdoc
     * @return InstitucionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InstitucionQuery(get_called_class());
    }
}
