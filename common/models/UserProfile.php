<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;
use common\models\PostalCode;
/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property integer $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $gender
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const STATUS_APPROVED = 1;
    const STATUS_UNAPPROVED = 0;
    const STATUS_INACTIVE = -1;
    const STATUS_DELETED = -10;
    /**
     * @var
     */
    public $picture, $age, $city;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'picture',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ],   
        ];
    }


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
            [['id', 'gender', 'aviliable_for_interview', 'over_18', 'eligible_to_work', 'have_work_visa',
              'employed', 'may_contact_employer', 'weekly_salary', 'rate_communication_skills', 'hours_per_week',
              'housekeep_communication_skills', 'housekeep_organization_skills', 'drive', 'have_car', 'car_insurance',
              'use_car_for_work', 'valid_licence','crp_certified','first_aid_certified','need_crp_fa_renew',
              'tb_test', 'pet_allergies', 'smoking', 'work_if_parent_smokes', 'valid_passport',
              'work_if_parent_at_home', 'miles_to_commute', 'child_of_your_own', 'dog_cat_at_home', 'swim', 
              'uniform_dress_code','status', 'laundry_and_ironing',  'help_with_childcare', 'work_at_home_with_child',
              'zip_code',
              
              ], 'integer'],
            [['position_for', 'availability', 'houskeeping', 'best_describes_housekeeping'],  'each', 'rule' => ['integer']],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['name', 'avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            [['unique_link', 'reg_date', 'phone_home', 'phone_cell', 'email','date_of_birth', 'personal_comments', 
              'when_can_start', 'hourly_rate', 'wage_comment', 'childcare_exp', 'ages_to_work_with', 'most_exp_with', 'cared_of_twins',
              'special_needs_exp', 'tutor', 'why_want_be_nanny',
              'type_of_activities', 'characteristics_look_for', 'background_in_child_dev', 'number_of_children_care_for',
              'sick_children', 'assist_homework', 'family_life', 'interests', 'philosophy', 'most_important',
              'largest_house','sun','mon','tue','wed','thu','fri','sat','schedule_comment', 'schedule_comment', 'level_of_school' ,
              'name_of_school', 'college', 'college_location', 'subjects_studied', 'spec_training', 'certificates',
              'state_licence', 'company_car_insurance', 'traffic_citations', 'traffic_citations_last5_yrs',
              'car_model_year','houskeep_years_exp', 'largest_house', 'personal_style_of_service', 'private_household',
              'not_willing_housework', 'crime','travel_restrictions', 'states_lived_in', 'travel_restrictions', 'extra_activities',
              'type_of_family', 'short_term_goals', 'why_qualified',  'languages','address', 'biography',
              

              ], 'string'],
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
            'address' => 'Address:',
            'zip_code' => 'Zip Code',
            'biography' => 'Candidate Biography: (Please write a little bit about yourself and your experience)',
            'phone_home' => 'Home Phone',
            'phone_cell' => 'Cellphone',
            'email' => 'Email',
            'aviliable_for_interview' => 'Aviliable for interview?',
            'over_18' => 'Over 18?',
            'date_of_birth' => 'Date Of Birth',
            'eligible_to_work' => 'Eligible to work in the U.S?',
            'have_work_visa' => 'Do you have a Work Visa?',
            'personal_comments' => 'Comments:',
            'position_for' => 'Position Applying For: (Check all that apply)',
            'employed' => 'Are you currently employed?',
            'may_contact_employer' => 'May we contact your employer?',
            'when_can_start' => 'When can you start?',
            'hours_per_week' => 'Hours willing to work per week?',
            'hourly_rate' => 'Gross hourly rate?',
            'weekly_salary' => 'Weekly salary requested?',
            'wage_comment' => 'Additional wage comment:',
            'availability' => 'Availability',
            'sun' => 'Sun',
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri',
            'sat' => 'Sat',
            'schedule_comment' => 'Schedule Comment',
            'level_of_school' => 'What level of school did you complete?',
            'name_of_school' => 'Name of High School:',
            'college' => 'College:',
            'college_location' => 'College location:',
            'subjects_studied' => 'Subjects Studied:',
            'spec_training' => 'Any specialized training? If so, what training?',
            'certificates' => 'Any certificates? If so, please list:',
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
            'houskeep_years_exp' => 'How many years experience?',
            'largest_house' => 'What is the largest house you have cleaned? ( For ex. 6 bedrooms)',
            'laundry_and_ironing' => 'Will you perform laundry and ironing? ',
            'best_describes_housekeeping' => 'What best describes your housekeeping standards? (check off)',
            'housekeep_communication_skills' => 'Rate yourself on communication skills: (1-10)',
            'housekeep_organization_skills' => 'Rate yourself on organizational skills: (1-10)',
            'personal_style_of_service' => 'What is your personal style of service? (check one)',
            'private_household' => 'Have you worked in a private household? How long?',
            'work_at_home_with_child' => 'Are you willing to work at home with a child? ',
            'help_with_childcare' => 'Are you willing to help the family with childcare when needed? ',
            'not_willing_housework' => 'Describe the type of household duties you are NOT willing to perform:',
            'crp_certified' => 'CPR certified?',
            'first_aid_certified' => 'First Aid Certified? ',
            'need_crp_fa_renew' => 'Do you need to get your CPR or First Aid renewed? ',
            'tb_test' => 'Have you had a TB test?  ',
            'pet_allergies' => 'Have any pet allergies?',
            'smoking' => 'Do you smoke? ',
            'work_if_parent_smokes' => 'Will you work at home with a parent that smokes?',
            'travel_restrictions' => 'Any travel restrictions? ',
            'valid_passport' => 'Have a valid passport? ',
            'work_if_parent_at_home' => 'Will you work in a home with a parent that is home? ',
            'miles_to_commute' => 'Miles you are willing to commute:',
            'child_of_your_own' => 'Do you have a child of your own you need to bring? ',
            'dog_cat_at_home' => 'Work with a dog or cat at home?',
            'swim' => 'Do you swim?',
            'uniform_dress_code' => 'Would you wear a uniform or dress code? ',
            'crime' => 'Have you ever been convicted of a crime? If so, please explain:',
            'benefits' => 'Benefits',
            'trawel_with_family' => 'Will you travel with the family?',
            'drive' => 'Do you drive?',
            'have_car' => 'Have a car?',
            'state_licence' => 'State your license was issued:',
            'car_insurance' => 'Have car insurance?',
            'company_car_insurance' => 'What company?',
            'traffic_citations' => 'Had any traffic citations (including DWI, DUI)?',
            'states_lived_in' => 'List all cities you have lived in and for how long:',
            'valid_licence' => 'Do you have a license that is valid and not under suspension?',
            'use_car_for_work' => 'Will you use your car for work purposes?',
            'traffic_citations_last5_yrs' => 'Have you had traffic citations in the last 5 years? If so, please list:',
            'car_model_year' => 'Car make, model and year:',
            'extra_activities' => 'What extra curricular activities/special skills or hobbies are you interested in?',
            'type_of_family' => 'Describe the type of family you would like to work for:',
            'short_term_goals' => 'What are your short term goals?',
            'why_qualified' => 'Why do you think you are qualified for this position?',
            'languages' => 'What languages do you speak?',
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
        if($this->zip_code!=0){
            $this->city = new PostalCode($this->zip_code);
            $this->city->getCity();
        }else{
            $this->city = new PostalCode("92011");
            $this->city->place_name="N/A";
        }
        
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
    
    /**
     * @return null|string
     */
    public function getFullName()
    {
        
        return null;
    }

    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : $default;
    }
    public function getPublicIdentity()
    {
        return $this->email;
    }
    public static function statuses()
    {
        return [
            self::STATUS_APPROVED => Yii::t('common', 'Approved'),
            self::STATUS_UNAPPROVED => Yii::t('common', 'Unapproved'),
            self::STATUS_INACTIVE => Yii::t('common', 'Inactive'),
            self::STATUS_DELETED => Yii::t('common', 'Deleted')
        ];
    }
}
