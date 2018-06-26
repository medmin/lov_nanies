<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body', 'verifyCode'], 'required'],
            // We need to sanitize them
            [['name', 'subject', 'body'], 'filter', 'filter' => 'strip_tags'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('frontend', 'Name'),
            'email' => Yii::t('frontend', 'Email'),
            'subject' => Yii::t('frontend', 'Subject'),
            'body' => Yii::t('frontend', 'Body'),
            'verifyCode' => Yii::t('frontend', 'Verification Code')
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact()
    {
        if ($this->validate()) {
            try{
                (new \common\lib\SendEmail([
                    'subject' => 'We have got your message ' . date('Y-m-d', time()),
                    'to' => [$this->email, 'info@nannycare.com'],
                    'body' => '<h2>Hi, '. $this->name .'<br /></h2><h4>Your message is :' . $this->body . '<br /></h4><h4>Thank you! We will contact you soon.</h4><br />Thank you,<br />Team NannyCare.com'
                ]))->handle() ;
            } 
            catch(\Exception $e)
            {
                throw $e;
            }
            return true;
        } else {
            return false;
        }
    }
}
