<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\AlertType]].
 *
 * @see \app\models\AlertType
 */
class AlertTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\AlertType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\AlertType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
