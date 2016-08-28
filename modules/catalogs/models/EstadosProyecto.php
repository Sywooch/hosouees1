<?php

namespace app\modules\catalogs\models;

use Yii;

/**
 * This is the model class for table "estadosProyecto".
 *
 * @property integer $IdEstadoProyecto
 * @property string $EstadoProyecto
 * @property string $EstadoRegistro
 *
 * @property Proyecto[] $proyectos
 */
class EstadosProyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estadosProyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EstadoProyecto'], 'string', 'max' => 45],
            [['EstadoRegistro'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IdEstadoProyecto' => Yii::t('app', 'Id Estado Proyecto'),
            'EstadoProyecto' => Yii::t('app', 'Estado Proyecto'),
            'EstadoRegistro' => Yii::t('app', 'Estado Registro'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['IdEstadoProyecto' => 'IdEstadoProyecto'])->inverseOf('idEstadoProyecto');
    }

    /**
     * @inheritdoc
     * @return EstadosProyectoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadosProyectoQuery(get_called_class());
    }
}
