<?php

namespace app\modules\catalogs\models;

/**
 * This is the ActiveQuery class for [[EstadosProyecto]].
 *
 * @see EstadosProyecto
 */
class EstadosProyectoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EstadosProyecto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EstadosProyecto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
