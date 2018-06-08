<?php
namespace common\lib;

use yii\base\Object;
use Mailgun\Mailgun;

class SendEmail extends Object
{
    public $from, $to, $subject, $body;

    public function init()
    {
        $this->from = $this->from ?: env('ROBOT_EMAIL');
    }

    /**
     * @return \Exception|\Mailgun\Model\Message\SendResponse
     */
    public function handle()
    {
        try {
            $mg = Mailgun::create(env('MAILGUN_KEY'));
//            $mg->setSslEnabled(!env('YII_DEBUG'));
            // $to could be an array
            return $mg->messages()->send(env('MAIL_SERVICE_URL'), [
                'from'    => env('NOREPLY_EMAIL'),
                'to'      => $this->to,
                'subject' => $this->subject,
                'html'    => $this->body
            ]);
        } catch (\Exception $e) {
            return $e;
        }

    }
}