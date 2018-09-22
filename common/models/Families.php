<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "families".
 *
 * @property int $id
 * @property int $status
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $children
 * @property string $type_of_help
 * @property string $work_out_of_home
 * @property string $special_needs
 * @property string $driving
 * @property string $when_start
 * @property string $how_heared_about_us
 * @property string $what_hours
 * @property string $pay_rate
 * @property string $housekeeping_or_cooking
 */
class Families extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_APPROVED = 1;
    const STATUS_UNAPPROVED = 0;
    const STATUS_INACTIVE = -1;
    const STATUS_DELETED = -10;

    public static function tableName()
    {
        return 'families';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'name', 'address', 'phone', 'children', 'type_of_help', 'work_out_of_home', 'special_needs', 'driving', 'when_start', 'how_heared_about_us', 'what_hours', 'pay_rate', 'housekeeping_or_cooking'], 'required'],
            [['id', 'status', 'pay_rate'], 'integer'],
            [['name', 'address', 'phone', 'children', 'type_of_help', 'work_out_of_home', 'special_needs', 'driving', 'when_start', 'how_heared_about_us'], 'string'],
            [['id'], 'unique'],
            [['what_hours', 'housekeeping_or_cooking'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                      => 'ID',
            'status'                  => 'Status',
            'name'                    => 'Name',
            'address'                 => 'Address',
            'phone'                   => 'Phone',
            'children'                => 'How many children and their ages?',
            'type_of_help'            => 'What type of help are you looking for?',
            'work_out_of_home'        => 'Do you work out of the home?',
            'special_needs'           => 'Do your children have any special needs?',
            'driving'                 => 'Any driving?',
            'when_start'              => 'When are you looking for nanny to start?',
            'how_heared_about_us'     => 'How did you hear about us?',
            'what_hours'              => 'What hours do you need?', //意思是保姆几点来工作
            'pay_rate'                => 'Pay rate you are offering?',
            'housekeeping_or_cooking' => 'Is there any housekeeping or cooking? If so, please tell us what you need...',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public function getPublicIdentity()
    {
        return $this->id;
    }

    public static function statuses()
    {
        return [
            self::STATUS_APPROVED   => Yii::t('common', 'Approved'),
            self::STATUS_UNAPPROVED => Yii::t('common', 'Unapproved'),
            self::STATUS_INACTIVE   => Yii::t('common', 'Inactive'),
            self::STATUS_DELETED    => Yii::t('common', 'Deleted'),
        ];
    }

    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url.'/'.$this->avatar_path)
            : $default;
    }

    public function getFullName()
    {
    }
}
