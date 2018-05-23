<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employment".
 *
 * @property integer $id
 * @property string $email
 * @property string $employer_name
 * @property string $employer_address
 * @property string $from_date
 * @property string $to_date
 * @property string $position_type
 * @property integer $number_of_children
 * @property string $ages_of_children_started
 * @property string $ages_of_children_left
 * @property string $responsibilities
 * @property string $salary_starting
 * @property string $salary_ending
 * @property string $may_we_contact
 * @property string $contact_phone
 * @property string $contact_email
 * @property string $reason_for_leaving
 * @property string $hours_worked
 * @property string $was_this_a_live_in_position
 * @property string $emloyer_comment
 */
class Employment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employer_name', 'employer_address', 'from_date', 'to_date', 'position_type', 'number_of_children', 'ages_of_children_started', 'ages_of_children_left', 'responsibilities', 'salary_starting', 'salary_ending', 'may_we_contact', 'contact_phone', 'contact_email', 'reason_for_leaving', 'hours_worked', 'was_this_a_live_in_position', 'emloyer_comment'], 'required'],
            [['id', 'number_of_children'], 'integer'],
            [['email', 'employer_name', 'employer_address', 'from_date', 'to_date', 'position_type', 'ages_of_children_started', 'ages_of_children_left', 'responsibilities', 'salary_starting', 'salary_ending', 'may_we_contact', 'contact_phone', 'contact_email', 'reason_for_leaving', 'hours_worked', 'was_this_a_live_in_position', 'emloyer_comment'], 'string'],
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
            'employer_name' => 'Employer Name',
            'employer_address' => 'Employer Address',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'position_type' => 'Position Type',
            'number_of_children' => 'Number Of Children',
            'ages_of_children_started' => 'Ages Of Children Started',
            'ages_of_children_left' => 'Ages Of Children Left',
            'responsibilities' => 'Responsibilities',
            'salary_starting' => 'Salary Starting',
            'salary_ending' => 'Salary Ending',
            'may_we_contact' => 'May We Contact',
            'contact_phone' => 'Contact Phone',
            'contact_email' => 'Contact Email',
            'reason_for_leaving' => 'Reason For Leaving',
            'hours_worked' => 'Hours Worked',
            'was_this_a_live_in_position' => 'Was This A Live In Position',
            'emloyer_comment' => 'Emloyer Comment',
        ];
    }
}
