<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * @property int $user_id
 * @property int $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property int $gender
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
    public $picture;
    public $age;
    public $city;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class'            => UploadBehavior::className(),
                'attribute'        => 'picture',
                'pathAttribute'    => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['locale'], 'required'],
            [['gender'], 'integer'],
            [['firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url'], 'string', 'max' => 255],
            [['locale'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id'         => 'User ID',
            'firstname'       => 'First Name',
            'middlename'      => 'Middle Name',
            'lastname'        => 'Last Name',
            'avatar_path'     => 'Avatar Path',
            'avatar_base_url' => 'Avatar Base Url',
            'locale'          => 'Locale',
            'gender'          => 'Gender',
        ];
    }

//    public function beforeSave($insert)
//    {
//        if (parent::beforeSave($insert)) {
//            if($this->position_for!=''){
//                $a=$this->position_for;
//                $this->position_for='';
//                foreach($a as $number){
//                    $this->position_for.=$number;
//                }
//            }
//            if($this->availability!=''){
//                $a=$this->availability;
//                $this->availability='';
//                foreach($a as $number){
//                    $this->availability.=$number;
//                }
//            }
//            if($this->houskeeping!=''){
//                $a=$this->houskeeping;
//                $this->houskeeping='';
//                foreach($a as $number){
//                    $this->houskeeping.=$number;
//                }
//            }
//            if($this->best_describes_housekeeping!=''){
//                $a=$this->best_describes_housekeeping;
//                $this->best_describes_housekeeping='';
//                foreach($a as $number){
//                    $this->best_describes_housekeeping.=$number;
//                }
//            }
//
//            return true;
//        }
//        return false;
//    }
//    public function afterFind()
//    {
//        parent::afterFind();
//        $this->doArray();
//        $this->age=$this->get_age($this->date_of_birth);
//        if($this->zip_code!=0){
//            $this->city = new PostalCode($this->zip_code);
//            $this->city->getCity();
//        }else{
//            $this->city = new PostalCode("92011");
//            $this->city->place_name="N/A";
//        }
//
//    }
//    public function doArray(){
//        if($this->position_for!=''){
//            $this->position_for=str_split($this->position_for);
//        }
//        else{
//            $this->position_for=array();
//        }
//        if($this->availability!=''){
//            $this->availability=str_split($this->availability);
//        }
//        else{
//            $this->availability=array();
//        }
//        if($this->houskeeping!=''){
//            $this->houskeeping=str_split($this->houskeeping);
//        }
//        else{
//            $this->houskeeping=array();
//        }
//        if($this->best_describes_housekeeping!=''){
//            $this->best_describes_housekeeping=str_split($this->best_describes_housekeeping);
//        }else{
//            $this->best_describes_housekeeping=array();
//        }
//    }
//    private function get_age($date_of_birth){
//        $year=date("Y");
//        if(preg_match("/\d[0-9]{3}/",$date_of_birth,$matches)){
//          $born= $date_of_birth."---".$matches[0]."<br>";
//          $age=$year-$matches[0];
//          if($age==$year){
//            $age="N/A";
//          }
//        }else{
//          if(preg_match("/[456789]{1}\d[0-9]{0}/",$date_of_birth,$matches)){
//            $born= $date_of_birth."---19".$matches[0]."<br>";
//            $matches[0]="19".$matches[0];
//            $age=$year-$matches[0];
//          }else{
//            //echo $row['date_of_birth']."<br>";
//            $age="N/A";
//          }
//        }
//        return $age;
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return null|string
     */
    public function getFullName()
    {
    }

    /**
     * @param null $default
     *
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url.'/'.$this->avatar_path)
            : $default;
    }

    public function getPublicIdentity()
    {
        return $this->email;
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
}
