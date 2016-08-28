<?php

namespace app\modules\catalogs\models;

/**
 * This is the ActiveQuery class for [[UserAccounts]].
 *
 * @see UserAccounts
 */
class UserAccountsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UserAccounts[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserAccounts|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
