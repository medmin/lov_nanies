<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parent_nanny".
 *
 * @property int $id
 * @property int $parentid
 * @property int $nannyid
 * @property int $timestamp
 *
 * @property Nannies $nanny
 */
class ParentNanny extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parent_nanny';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'nannyid', 'timestamp'], 'required'],
            [['id', 'parentid', 'nannyid', 'timestamp'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parentid' => Yii::t('app', 'Parent ID'),
            'nannyid' => Yii::t('app', 'Nanny ID'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }

    public function getNanny()
    {
        return $this->hasOne(Nannies::className(), ['id' => 'nannyid']);
    }

}

