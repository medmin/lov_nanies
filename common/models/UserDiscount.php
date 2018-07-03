<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_discount".
 *
 * @property integer $user_id
 * @property double $discount
 * @property integer $created_at
 * @property integer $expired_at
 */
class UserDiscount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'discount'], 'required'],
            ['discount', 'integer', 'min' => 0, 'max' => 100],
            [['user_id', 'created_at'], 'integer'],
            ['expired_at', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'discount' => 'Discount ( % off )',
            'created_at' => 'Created At',
            'expired_at' => 'Expired At',
        ];
    }

    /**
     * 获取所有用户折扣
     *
     * @return mixed|null
     */
    public static function getAllDiscount()
    {
        $model = self::find()
            ->where(['user_id' => 0])
            ->andWhere(['>', 'expired_at', time()])
            ->one();
        if ($model) {
            //美式折扣是多少off，例如，30%，对应了中国的打7折
            return 100-$model->discount; 
        }
        return null;
    }

    /**
     * 获取单个用户折扣（如果不存在，返回所有用户折扣）
     *
     * @param null $user_id
     * @return mixed|null
     */
    public static function getCurrentDiscount($user_id = null)
    {
        $user_id = $user_id === null ? Yii::$app->user->id : $user_id;
        $model = self::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['>', 'expired_at', time()])
            ->one();
        if ($model) {
            //美式折扣是多少off，例如，30%，对应了中国的打7折
            return 100-$model->discount;
        }
        return self::getAllDiscount();
    }
}
