<?php

namespace common\models;

use common\queue\EmailJob;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user_notify".
 *
 * @property int $id
 * @property string $subject
 * @property string $content
 * @property int $sender_id
 * @property int $receiver_id
 * @property int $pid
 * @property int $job_post_id
 * @property int $status
 * @property int $is_read
 * @property int $send_mail
 * @property int $created_at
 * @property int $sender_at
 */
class UserNotify extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_notify';
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'subject'     => 'Subject',
            'content'     => 'Content',
            'sender_id'   => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'pid'         => 'Pid',
            'job_post_id' => 'Job Post ID',
            'status'      => 'Status',
            'is_read'     => 'Is Read',
            'send_mail'   => 'Send Mail',
            'created_at'  => 'Created At',
            'sender_at'   => 'Sender At',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public static function UnreadNotifyCount()
    {
        return self::find()->where(['receiver_id' => Yii::$app->user->id, 'is_read' => 0])->count();
    }

    /**
     * @param bool $insert
     *
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->sender_id = Yii::$app->user->id;
        }

        return parent::beforeSave($insert);
    }

    /**
     * 保存之后给用户发送邮件.
     *
     * @param bool  $insert            「true 表示是新增记录， false 为更新记录」
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $email = User::findById($this->receiver_id)->email;

            $sender_username = User::findById($this->sender_id)->username;

            Yii::$app->queue->push(new EmailJob([
                'email'       => $email,
                'subject'     => $sender_username.' sent a new message: '.$this->subject,
                'body'        => 'Full message: <br>'.$this->content."<br><br><strong>Please log in to send a reply</strong>: <a href='https://membership.nannycare.com'>https://membership.nannycare.com</a>.",
                'category'    => self::class,
                'callback_id' => $this->id,
            ]));
        }
    }
}
