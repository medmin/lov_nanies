<?php

namespace common\models;

use Yii;

use yii\db\ActiveRecord;
use trntv\filekit\behaviors\UploadBehavior;


/**
 * This is the model class for table "nannies".
 *
 * @property integer $id
 * @property integer $status
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property string $unique_link
 * @property string $reg_date
 * @property string $password
 * @property string $name
 * @property string $address
 * @property integer $zip_code
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
 * @property string $locale
 * @property integer $gender
 */
class Nannies extends ActiveRecord
{
    const STATUS_APPROVED = 1;
    const STATUS_UNAPPROVED = 0;
    const STATUS_INACTIVE = -1;
    const STATUS_DELETED = -10;

    public $picture, $age, $city;

    /**
     * @return array
     */
//    public function behaviors()
//    {
//        return [
//            'picture' => [
//                'class' => UploadBehavior::className(),
//                'attribute' => 'picture',
//                'pathAttribute' => 'avatar_path',
//                'baseUrlAttribute' => 'avatar_base_url'
//            ],
//        ];
//    }

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
            [['status', 'zip_code', 'aviliable_for_interview', 'over_18', 'eligible_to_work', 'have_work_visa', 'employed', 'may_contact_employer', 'hours_per_week', 'weekly_salary', 'rate_communication_skills', 'laundry_and_ironing', 'housekeep_communication_skills', 'housekeep_organization_skills', 'work_at_home_with_child', 'help_with_childcare', 'crp_certified', 'first_aid_certified', 'need_crp_fa_renew', 'tb_test', 'pet_allergies', 'smoking', 'work_if_parent_smokes', 'valid_passport', 'work_if_parent_at_home', 'miles_to_commute', 'child_of_your_own', 'dog_cat_at_home', 'swim', 'uniform_dress_code', 'benefits', 'trawel_with_family', 'drive', 'have_car', 'car_insurance', 'valid_licence', 'use_car_for_work', 'city', 'gender'], 'integer'],
            [['avatar_path', 'avatar_base_url', 'unique_link', 'password', 'name', 'address', 'biography', 'phone_home', 'phone_cell', 'email', 'date_of_birth', 'personal_comments', 'when_can_start', 'hourly_rate', 'wage_comment', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'schedule_comment', 'level_of_school', 'name_of_school', 'college', 'college_location', 'subjects_studied', 'spec_training', 'certificates', 'childcare_exp', 'ages_to_work_with', 'most_exp_with', 'cared_of_twins', 'special_needs_exp', 'tutor', 'why_want_be_nanny', 'type_of_activities', 'characteristics_look_for', 'background_in_child_dev', 'number_of_children_care_for', 'sick_children', 'assist_homework', 'family_life', 'interests', 'philosophy', 'most_important', 'houskeep_years_exp', 'largest_house', 'personal_style_of_service', 'private_household', 'not_willing_housework', 'travel_restrictions', 'crime', 'state_licence', 'company_car_insurance', 'traffic_citations', 'states_lived_in', 'traffic_citations_last5_yrs', 'car_model_year', 'extra_activities', 'type_of_family', 'short_term_goals', 'why_qualified', 'languages', 'heared_about_us', 'rate_candidate', 'notes', 'trustline', 'back_checks', 'attach1', 'attach2', 'attach3', 'attach12', 'attach13', 'attach22', 'attach23', 'attach32', 'attach33', 'locale'], 'string'],
            [['picture', 'reg_date', 'position_for', 'availability', 'houskeeping', 'best_describes_housekeeping'], 'safe']
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->position_for!=''){
                $a=$this->position_for;
                $this->position_for='';
                foreach($a as $number){
                    $this->position_for.=$number;
                }
            }
            if($this->availability!=''){
                $a=$this->availability;
                $this->availability='';
                foreach($a as $number){
                    $this->availability.=$number;
                }
            }
            if($this->houskeeping!=''){
                $a=$this->houskeeping;
                $this->houskeeping='';
                foreach($a as $number){
                    $this->houskeeping.=$number;
                }
            }
            if($this->best_describes_housekeeping!=''){
                $a=$this->best_describes_housekeeping;
                $this->best_describes_housekeeping='';
                foreach($a as $number){
                    $this->best_describes_housekeeping.=$number;
                }
            }

            return true;
        }
        return false;
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->doArray();
        $this->age=$this->get_age($this->date_of_birth);

        // 先注释下边这个，用了一大堆放弃的mysql函数

//        if($this->zip_code!=0){
//            $this->city = new PostalCode($this->zip_code);
//            $this->city->getCity();
//        }else{
//            $this->city = new PostalCode("92011");
//            $this->city->place_name="N/A";
//        }

    }
    public function doArray(){
        if($this->position_for!=''){
            $this->position_for=str_split($this->position_for);
        }
        else{
            $this->position_for=array();
        }
        if($this->availability!=''){
            $this->availability=str_split($this->availability);
        }
        else{
            $this->availability=array();
        }
        if($this->houskeeping!=''){
            $this->houskeeping=str_split($this->houskeeping);
        }
        else{
            $this->houskeeping=array();
        }
        if($this->best_describes_housekeeping!=''){
            $this->best_describes_housekeeping=str_split($this->best_describes_housekeeping);
        }else{
            $this->best_describes_housekeeping=array();
        }
    }
    private function get_age($date_of_birth){
        $year=date("Y");
        if(preg_match("/\d[0-9]{3}/",$date_of_birth,$matches)){
          $born= $date_of_birth."---".$matches[0]."<br>";
          $age=$year-$matches[0];
          if($age==$year){
            $age="N/A";
          }
        }else{
          if(preg_match("/[456789]{1}\d[0-9]{0}/",$date_of_birth,$matches)){
            $born= $date_of_birth."---19".$matches[0]."<br>";
            $matches[0]="19".$matches[0];
            $age=$year-$matches[0];
          }else{
            //echo $row['date_of_birth']."<br>";
            $age="N/A";
          }
        }
        return $age;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'avatar_path' => 'Avatar Path',
            'avatar_base_url' => 'Avatar Base Url',
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
            'sun' => 'Sun:',
            'mon' => 'Mon:',
            'tue' => 'Tue:',
            'wed' => 'Wed:',
            'thu' => 'Thu:',
            'fri' => 'Fri:',
            'sat' => 'Sat:',
            'schedule_comment' => 'Comment',
            'level_of_school' => 'Level Of School',
            'name_of_school' => 'Name Of School',
            'college' => 'College',
            'college_location' => 'College Location',
            'subjects_studied' => 'Subjects Studied',
            'spec_training' => 'Spec Training',
            'certificates' => 'Certificates',
            'childcare_exp' => 'Years of childcare experience:',
            'ages_to_work_with' => 'What ages will you work with?',
            'most_exp_with' => 'What ages do you have the most experience with?',
            'cared_of_twins' => 'Have you cared for twins or multiples?',
            'special_needs_exp' => 'Do you have special needs experience? If so, what kind?',
            'tutor' => 'Would you tutor? If so, what subjects?',
            'houskeeping' => 'Will you do any housekeeping? If so, please check off the duties you will perform.',
            'why_want_be_nanny' => 'Why do you want to be a nanny?',
            'type_of_activities' => 'What type of activities would you do with the children?',
            'characteristics_look_for' => 'If you were a parent looking for a nanny, what characteristics would you look for?',
            'background_in_child_dev' => 'Do you have any background in child development? If so, how many units?',
            'number_of_children_care_for' => 'How many children will you care for?',
            'sick_children' => 'Would you care for sick children?',
            'assist_homework' => 'Will you assist children with homework?',
            'family_life' => 'Briefly tell us about your family life?',
            'interests' => 'What are your interests?',
            'philosophy' => 'What is your philosophy on discipline?',
            'most_important' => 'What is most important for a good relationship between a nanny and parents?',
            'rate_communication_skills' => 'Rate yourself on communication skills: (1-10)',
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
            'locale' => 'Locale',
            'gender' => 'Gender',
        ];
    }

    public static function initialization()
    {
        if (Yii::$app->user->identity->nannies === null) {
            $model = new Nannies();
            $model->setAttributes([
                'id' => Yii::$app->user->id,
                'status' => 0,
                'avatar_path' => '',
                'avatar_base_url' => '',
                'unique_link' => '',
                'reg_date' => date('Y-m-d'),
                'password' => '',
                'name' => '',
                'address' => '',
                'zip_code' => 0,
                'biography' => '',
                'phone_home' => '',
                'phone_cell' => '',
                'email' => '',
                'aviliable_for_interview' => 1, // available
                'over_18' => 1,
                'date_of_birth' => '',
                'eligible_to_work' => 0,
                'have_work_visa' => 0,
                'personal_comments' => '',
                'position_for' => '',
                'employed' => 0,
                'may_contact_employer' => 0,
                'when_can_start' => '',
                'hours_per_week' => 0,
                'hourly_rate' => '',
                'weekly_salary' => 0,
                'wage_comment' => '',
                'availability' => '',
                'sun' => '',
                'mon' => '',
                'tue' => '',
                'wed' => '',
                'thu' => '',
                'fri' => '',
                'sat' => '',
                'schedule_comment' => '',
                'level_of_school' => '',
                'name_of_school' => '',
                'college' => '',
                'college_location' => '',
                'subjects_studied' => '',
                'spec_training' => '',
                'certificates' => '',
                'childcare_exp' => '',
                'ages_to_work_with' => '',
                'most_exp_with' => '',
                'cared_of_twins' => '',
                'special_needs_exp' => '',
                'tutor' => '',
                'houskeeping' => '',
                'why_want_be_nanny' => '',
                'type_of_activities' => '',
                'characteristics_look_for' => '',
                'background_in_child_dev' => '',
                'number_of_children_care_for' => '',
                'sick_children' => '',
                'assist_homework' => '',
                'family_life' => '',
                'interests' => '',
                'philosophy' => '',
                'most_important' => '',
                'rate_communication_skills' => 0,
                'houskeep_years_exp' => '',
                'largest_house' => '',
                'laundry_and_ironing' => 0,
                'best_describes_housekeeping' => '',
                'housekeep_communication_skills' => 0,
                'housekeep_organization_skills' => 0,
                'personal_style_of_service' => '',
                'private_household' => '',
                'work_at_home_with_child' => 0,
                'help_with_childcare' => 0,
                'not_willing_housework' => '',
                'crp_certified' => 0,
                'first_aid_certified' => 0,
                'need_crp_fa_renew' => 0,
                'tb_test' => 0,
                'pet_allergies' => 0,
                'smoking' => 0,
                'work_if_parent_smokes' => 0,
                'travel_restrictions' => '',
                'valid_passport' => 0,
                'work_if_parent_at_home' => 0,
                'miles_to_commute' => 0,
                'child_of_your_own' => 0,
                'dog_cat_at_home' => 0,
                'swim' => 0,
                'uniform_dress_code' => 0,
                'crime' => '',
                'benefits' => 0,
                'trawel_with_family' => 0,
                'drive' => 0,
                'have_car' => 0,
                'state_licence' => '',
                'car_insurance' => 0,
                'company_car_insurance' => '',
                'traffic_citations' => '',
                'states_lived_in' => '',
                'valid_licence' => 0,
                'use_car_for_work' => 0,
                'traffic_citations_last5_yrs' => '',
                'car_model_year' => '',
                'extra_activities' => '',
                'type_of_family' => '',
                'short_term_goals' => '',
                'why_qualified' => '',
                'languages' => '',
                'heared_about_us' => '',
                'rate_candidate' => '',
                'notes' => '',
                'city' => 0,
                'trustline' => '',
                'back_checks' => '',
                'attach1' => '',
                'attach2' => '',
                'attach3' => '',
                'attach12' => '',
                'attach13' => '',
                'attach22' => '',
                'attach23' => '',
                'attach32' => '',
                'attach33' => '',
                'locale' => '',
                'gender' => 0, // db default 2
            ], false); // false 表示不检测字段安全，如果不设置，则会去rules找对应规则，没有的默认为NULL
            $model->save();
        }
    }
    
}
