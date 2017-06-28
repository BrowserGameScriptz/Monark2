<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\AlertRead]].
 *
 * @see \app\models\AlertRead
 */
class AlertReadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\AlertRead[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\AlertRead|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
