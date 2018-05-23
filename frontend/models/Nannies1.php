<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "nannies".
 *
 * @property integer $id
 * @property integer $status
 * @property string $unique_link
 * @property string $reg_date
 * @property string $password
 * @property string $name
 * @property string $address
 * @property string $biography
 * @property string $phone_home
 * @property string $phone_cell
 * @property string $email
 * @property integer $aviliable_for_interview
 * @property integer $over_18
 * @property string $date_of_birth
 * @property integer $eligible_to_work
 * @property integer $have_work_visa
 * @property string $personal_comments
 * @property string $position_for
 * @property integer $employed
 * @property integer $may_contact_employer
 * @property string $when_can_start
 * @property integer $hours_per_week
 * @property string $hourly_rate
 * @property integer $weekly_salary
 * @property string $wage_comment
 * @property string $availability
 * @property string $sun
 * @property string $mon
 * @property string $tue
 * @property string $wed
 * @property string $thu
 * @property string $fri
 * @property string $sat
 * @property string $schedule_comment
 * @property string $level_of_school
 * @property string $name_of_school
 * @property string $college
 * @property string $college_location
 * @property string $subjects_studied
 * @property string $spec_training
 * @property string $certificates
 * @property string $childcare_exp
 * @property string $ages_to_work_with
 * @property string $most_exp_with
 * @property string $cared_of_twins
 * @property string $special_needs_exp
 * @property string $tutor
 * @property string $houskeeping
 * @property string $why_want_be_nanny
 * @property string $type_of_activities
 * @property string $characteristics_look_for
 * @property string $background_in_child_dev
 * @property string $number_of_children_care_for
 * @property string $sick_children
 * @property string $assist_homework
 * @property string $family_life
 * @property string $interests
 * @property string $philosophy
 * @property string $most_important
 * @property integer $rate_communication_skills
 * @property string $houskeep_years_exp
 * @property string $largest_house
 * @property integer $laundry_and_ironing
 * @property string $best_describes_housekeeping
 * @property integer $housekeep_communication_skills
 * @property integer $housekeep_organization_skills
 * @property string $personal_style_of_service
 * @property string $private_household
 * @property integer $work_at_home_with_child
 * @property integer $help_with_childcare
 * @property string $not_willing_housework
 * @property integer $crp_certified
 * @property integer $first_aid_certified
 * @property integer $need_crp_fa_renew
 * @property integer $tb_test
 * @property integer $pet_allergies
 * @property integer $smoking
 * @property integer $work_if_parent_smokes
 * @property string $travel_restrictions
 * @property integer $valid_passport
 * @property integer $work_if_parent_at_home
 * @property integer $miles_to_commute
 * @property integer $child_of_your_own
 * @property integer $dog_cat_at_home
 * @property integer $swim
 * @property integer $uniform_dress_code
 * @property string $crime
 * @property integer $benefits
 * @property integer $trawel_with_family
 * @property integer $drive
 * @property integer $have_car
 * @property string $state_licence
 * @property integer $car_insurance
 * @property string $company_car_insurance
 * @property string $traffic_citations
 * @property string $states_lived_in
 * @property integer $valid_licence
 * @property integer $use_car_for_work
 * @property string $traffic_citations_last5_yrs
 * @property string $car_model_year
 * @property string $extra_activities
 * @property string $type_of_family
 * @property string $short_term_goals
 * @property string $why_qualified
 * @property string $languages
 * @property string $heared_about_us
 * @property string $rate_candidate
 * @property string $notes
 * @property integer $city
 * @property string $trustline
 * @property string $back_checks
 * @property string $attach1
 * @property string $attach2
 * @property string $attach3
 * @property string $attach12
 * @property string $attach13
 * @property string $attach22
 * @property string $attach23
 * @property string $attach32
 * @property string $attach33
 */
class Nannies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nannies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'gender'], 'integer'],
            [['name', 'avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            
            ['picture', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'unique_link' => 'Unique Link',
            'reg_date' => 'Reg Date',
            'password' => 'Password',
            'name' => 'Name',
            'address' => 'Address',
            'biography' => 'Biography',
            'phone_home' => 'Phone Home',
            'phone_cell' => 'Phone Cell',
            'email' => 'Email',
            'aviliable_for_interview' => 'Aviliable For Interview',
            'over_18' => 'Over 18',
            'date_of_birth' => 'Date Of Birth',
            'eligible_to_work' => 'Eligible To Work',
            'have_work_visa' => 'Have Work Visa',
            'personal_comments' => 'Personal Comments',
            'position_for' => 'Position For',
            'employed' => 'Employed',
            'may_contact_employer' => 'May Contact Employer',
            'when_can_start' => 'When Can Start',
            'hours_per_week' => 'Hours Per Week',
            'hourly_rate' => 'Hourly Rate',
            'weekly_salary' => 'Weekly Salary',
            'wage_comment' => 'Wage Comment',
            'availability' => 'Availability',
            'sun' => 'Sun',
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri',
            'sat' => 'Sat',
            'schedule_comment' => 'Schedule Comment',
            'level_of_school' => 'Level Of School',
            'name_of_school' => 'Name Of School',
            'college' => 'College',
            'college_location' => 'College Location',
            'subjects_studied' => 'Subjects Studied',
            'spec_training' => 'Spec Training',
            'certificates' => 'Certificates',
            'childcare_exp' => 'Childcare Exp',
            'ages_to_work_with' => 'Ages To Work With',
            'most_exp_with' => 'Most Exp With',
            'cared_of_twins' => 'Cared Of Twins',
            'special_needs_exp' => 'Special Needs Exp',
            'tutor' => 'Tutor',
            'houskeeping' => 'Houskeeping',
            'why_want_be_nanny' => 'Why Want Be Nanny',
            'type_of_activities' => 'Type Of Activities',
            'characteristics_look_for' => 'Characteristics Look For',
            'background_in_child_dev' => 'Background In Child Dev',
            'number_of_children_care_for' => 'Number Of Children Care For',
            'sick_children' => 'Sick Children',
            'assist_homework' => 'Assist Homework',
            'family_life' => 'Family Life',
            'interests' => 'Interests',
            'philosophy' => 'Philosophy',
            'most_important' => 'Most Important',
            'rate_communication_skills' => 'Rate Communication Skills',
            'houskeep_years_exp' => 'Houskeep Years Exp',
            'largest_house' => 'Largest House',
            'laundry_and_ironing' => 'Laundry And Ironing',
            'best_describes_housekeeping' => 'Best Describes Housekeeping',
            'housekeep_communication_skills' => 'Housekeep Communication Skills',
            'housekeep_organization_skills' => 'Housekeep Organization Skills',
            'personal_style_of_service' => 'Personal Style Of Service',
            'private_household' => 'Private Household',
            'work_at_home_with_child' => 'Work At Home With Child',
            'help_with_childcare' => 'Help With Childcare',
            'not_willing_housework' => 'Not Willing Housework',
            'crp_certified' => 'Crp Certified',
            'first_aid_certified' => 'First Aid Certified',
            'need_crp_fa_renew' => 'Need Crp Fa Renew',
            'tb_test' => 'Tb Test',
            'pet_allergies' => 'Pet Allergies',
            'smoking' => 'Smoking',
            'work_if_parent_smokes' => 'Work If Parent Smokes',
            'travel_restrictions' => 'Travel Restrictions',
            'valid_passport' => 'Valid Passport',
            'work_if_parent_at_home' => 'Work If Parent At Home',
            'miles_to_commute' => 'Miles To Commute',
            'child_of_your_own' => 'Child Of Your Own',
            'dog_cat_at_home' => 'Dog Cat At Home',
            'swim' => 'Swim',
            'uniform_dress_code' => 'Uniform Dress Code',
            'crime' => 'Crime',
            'benefits' => 'Benefits',
            'trawel_with_family' => 'Trawel With Family',
            'drive' => 'Drive',
            'have_car' => 'Have Car',
            'state_licence' => 'State Licence',
            'car_insurance' => 'Car Insurance',
            'company_car_insurance' => 'Company Car Insurance',
            'traffic_citations' => 'Traffic Citations',
            'states_lived_in' => 'States Lived In',
            'valid_licence' => 'Valid Licence',
            'use_car_for_work' => 'Use Car For Work',
            'traffic_citations_last5_yrs' => 'Traffic Citations Last5 Yrs',
            'car_model_year' => 'Car Model Year',
            'extra_activities' => 'Extra Activities',
            'type_of_family' => 'Type Of Family',
            'short_term_goals' => 'Short Term Goals',
            'why_qualified' => 'Why Qualified',
            'languages' => 'Languages',
            'heared_about_us' => 'Heared About Us',
            'rate_candidate' => 'Rate Candidate',
            'notes' => 'Notes',
            'city' => 'City',
            'trustline' => 'Trustline',
            'back_checks' => 'Back Checks',
            'attach1' => 'Attach1',
            'attach2' => 'Attach2',
            'attach3' => 'Attach3',
            'attach12' => 'Attach12',
            'attach13' => 'Attach13',
            'attach22' => 'Attach22',
            'attach23' => 'Attach23',
            'attach32' => 'Attach32',
            'attach33' => 'Attach33',
        ];
    }
    
}
