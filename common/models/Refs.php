<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "refs".
 *
 * @property integer $id
 * @property string $email
 * @property string $reference_name
 * @property string $reference_address
 * @property string $contact_number
 * @property string $ref_contact_email
 * @property string $how_do_you_know
 * @property string $years_known
 */
class Refs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'reference_name', 'reference_address', 'contact_number', 'ref_contact_email', 'how_do_you_know', 'years_known'], 'required'],
            [['id'], 'integer'],
            [['email', 'reference_name', 'reference_address', 'contact_number', 'ref_contact_email', 'how_do_you_know', 'years_known'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'reference_name' => 'Reference Name',
            'reference_address' => 'Reference Address',
            'contact_number' => 'Contact Number',
            'ref_contact_email' => 'Ref Contact Email',
            'how_do_you_know' => 'How Do You Know',
            'years_known' => 'Please describe your past job. Include  the ages of the child(ren) when you started, the job duties, whether it was full time, part time, live in/out and anything else you`ve like to include about this position. ',
        ];
    }
}
