<?php

namespace app\queries;

/**
 * This is the ActiveQuery class for [[\app\models\MailRead]].
 *
 * @see \app\models\MailRead
 */
class MailReadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\MailRead[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\MailRead|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
