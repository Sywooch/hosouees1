<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Comunicacion]].
 *
 * @see Comunicacion
 */
class ComunicacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Comunicacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Comunicacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
