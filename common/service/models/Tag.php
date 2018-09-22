<?php

namespace common\service\models;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $uid
 * @property string $target
 * @property string $name
 * @property string $icon
 * @property string $info
 * @property int $created_at
 * @property UserTag[] $userTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
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
            [['icon'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'uid'        => 'Uid',
            'target'     => 'Target',
            'name'       => 'Name',
            'icon'       => 'Icon',
            'info'       => 'Info',
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

    public function beforeSave($insert)
    {
        if (substr($this->icon, 0, 3) == 'fa-') {
            $this->icon = substr($this->icon, 3);
        }

        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        UserTag::deleteAll(['tag_id' => $this->id]);

        return parent::beforeDelete();
    }
}
