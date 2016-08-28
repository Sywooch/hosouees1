<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Formularios]].
 *
 * @see Formularios
 */
class FormulariosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Formularios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Formularios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
