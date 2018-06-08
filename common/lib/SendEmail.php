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
            return $mg->messages()->send('web.cardioanywhere.com', [
                'from'    => $this->from ?? env('ROBOT_EMAIL'),
                'to'      => $this->to,
                'subject' => $this->subject,
                'html'    => $this->body
            ]);
        } catch (\Exception $e) {
            return $e;
        }

    }
}