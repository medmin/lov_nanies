<?php

namespace common\service\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $uid
 * @property string $target
 * @property string $name
 * @property string $info
 * @property integer $created_at
 *
 * @property UserTag[] $userTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'target', 'name', 'created_at'], 'required'],
            [['info'], 'string'],
            [['created_at'], 'integer'],
            [['uid'], 'string', 'max' => 8],
            [['target'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'target' => 'Target',
            'name' => 'Name',
            'info' => 'Info',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTags()
    {
        return $this->hasMany(UserTag::className(), ['tag_id' => 'id']);
    }
}
