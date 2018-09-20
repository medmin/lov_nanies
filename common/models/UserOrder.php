<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_type
 * @property string $payment_gateway
 * @property string $payment_gateway_id
 * @property string $service_plan
 * @property integer $service_money
 * @property integer $timestamp
 * @property integer $expired_at
 */
class UserOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_type', 'payment_gateway', 'payment_gateway_id', 'service_plan', 'service_money', 'timestamp', 'expired_at'], 'required'],
            [['user_id', 'service_money', 'timestamp','expired_at'], 'integer'],
            [['user_type', 'payment_gateway'], 'string', 'max' => 20],
            [['payment_gateway_id'], 'string', 'max' => 200],
            [['service_plan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'user_type' => Yii::t('app', 'User Type'),
            'payment_gateway' => Yii::t('app', 'Payment Gateway'),
            'payment_gateway_id' => Yii::t('app', 'Payment Gateway ID'),
            'service_plan' => Yii::t('app', 'Service Plan'),
            'service_money' => Yii::t('app', 'Service Money'),
            'timestamp' => Yii::t('app', 'Paid At'),
            'expired_at' => Yii::t('app', 'Expired At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * parent service_plan
     *
     * @return array
     */
    public static function ParentServicePlans()
    {
        return [
            'basic' => '1 Month ($59)',
            'bronze' => '3 Months ($149)',
            'gold' => '12 Months ($479)'
        ];
    }

    /**
	 * @param $nanny_id
	 * @return integer | bool
	 *
	 * 直接倒序查询最后一个expired_at，大于当前时间说明没有到期，返回这个时间戳，否则返回false
     * 在view层使用： if (UserOrder::NannyListingFeeStatus(Yii::$app->user->id)) {...}
	 */
	public static function NannyListingFeeStatus($nanny_id)
	{
        $payrecord = UserOrder::find()
                    ->where(['user_id'=> $nanny_id])
                    ->andWhere(['in', "service_money", [0, 999]])
                    ->andWhere(['in',"service_plan", ['First-90-Days-Free-Listing','Listing Fee (Monthly Fee)']])
                    ->orderBy('expired_at DESC')
                    ->one();

		if ($payrecord && $payrecord->expired_at > time() ) {
			return $payrecord->expired_at;
		} else {
			return false;
		}
	}

    /**
     * @param $parent_id
     * @return integer|bool
     *
     * 判断 parent 是否可以发送文章，有的话返回到期时间戳
     */
    public static function ParentPostStatus($parent_id)
    {
        $record = UserOrder::find()->where(['user_id' => $parent_id])->andWhere(['service_plan' => 'Ninety-Days-Posting'])->orderBy('expired_at DESC')->one();
        if ($record && $record->expired_at > time()) {
            return $record->expired_at;
        } else {
            return false;
        }
	}
}
