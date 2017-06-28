<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Alert]].
 *
 * @see \app\models\Alert
 */
class AlertQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Alert[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Alert|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
