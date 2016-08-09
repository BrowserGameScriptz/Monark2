<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mail_read".
 *
 * @property string $mail_read_id
 * @property integer $mail_read_game_id
 * @property integer $mail_read_message_id
 * @property integer $mail_read_user_receive_id
 * @property integer $mail_read_time
 */
class MailRead extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail_read';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mail_read_game_id', 'mail_read_message_id', 'mail_read_user_receive_id', 'mail_read_time'], 'required'],
            [['mail_read_game_id', 'mail_read_message_id', 'mail_read_user_receive_id', 'mail_read_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mail_read_id' => 'Mail Read ID',
            'mail_read_game_id' => 'Mail Read Game ID',
            'mail_read_message_id' => 'Mail Read Message ID',
            'mail_read_user_receive_id' => 'Mail Read User Receive ID',
            'mail_read_time' => 'Mail Read Time',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\queries\MailReadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\queries\MailReadQuery(get_called_class());
    }
}
