<?php

namespace app\modules\catalogs\models;

/**
 * This is the ActiveQuery class for [[Proyecto]].
 *
 * @see Proyecto
 */
class ProyectoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Proyecto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Proyecto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
