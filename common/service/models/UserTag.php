<?php

namespace common\service\models;

use Yii;

/**
 * This is the model class for table "user_tag".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tag_id
 * @property integer $created_at
 *
 * @property Tag $tag
 */
class UserTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tag_id', 'created_at'], 'required'],
            [['user_id', 'tag_id', 'created_at'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'tag_id' => 'Tag ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

}
