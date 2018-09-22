<?php

namespace common\lib;

use Mailgun\Mailgun;
use yii\base\Object;

class SendEmail extends Object
{
    public $from;
    public $to;
    public $subject;
    public $body;

    public function init()
    {
        $this->from = $this->from ?: env('ROBOT_EMAIL');
    }

    /**
     * @return \Exception|\Mailgun\Model\Message\SendResponse|bool
     */
    public function handle()
    {
        if (env('IS_SEND') === false) {
            return false;
        }

        try {
            $mg = Mailgun::create(env('MAILGUN_KEY'));
//            $mg->setSslEnabled(!env('YII_DEBUG'));
            // $to could be an array
            return $mg->messages()->send(env('MAIL_SERVICE_URL'), [
                'from'    => env('NOREPLY_EMAIL'),
                'to'      => $this->to,
                'subject' => $this->subject,
                'html'    => $this->body,
            ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
