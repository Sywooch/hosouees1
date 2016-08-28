<?php

namespace app\modules\catalogs\models;

/**
 * This is the ActiveQuery class for [[Institucion]].
 *
 * @see Institucion
 */
class InstitucionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Institucion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Institucion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
