<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_order".
 *
 * @property string $id
 * @property string $user_id
 * @property string $user_type
 * @property string $payment_gateway
 * @property string $payment_gateway_id
 * @property string $service_plan
 * @property string $service_money
 * @property string $timestamp
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
}
