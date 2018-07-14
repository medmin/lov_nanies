<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_notify".
 *
 * @property integer $id
 * @property string $subject
 * @property string $content
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property integer $pid
 * @property integer $job_post_id
 * @property integer $status
 * @property integer $is_read
 * @property integer $send_mail
 * @property integer $created_at
 * @property integer $sender_at
 */
class UserNotify extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notify';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'content'], 'required'],
            [['content'], 'string'],
            [['subject'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'content' => 'Content',
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'pid' => 'Pid',
            'job_post_id' => 'Job Post ID',
            'status' => 'Status',
            'is_read' => 'Is Read',
            'send_mail' => 'Send Mail',
            'created_at' => 'Created At',
            'sender_at' => 'Sender At',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ]
        ];
    }

    public static function UnreadNotifyCount()
    {
        return UserNotify::find()->where(['receiver_id' => Yii::$app->user->id, 'is_read' => 0])->count();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->sender_id = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
}
