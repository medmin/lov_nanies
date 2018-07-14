<?php

/**
 * User: xczizz
 * Date: 2018/7/15
 * Time: 1:15
 */

namespace common\queue;

use common\lib\SendEmail;
use yii\base\Object;
use yii\queue\Job;

class EmailJob extends Object implements Job
{

    /**
     * 目标邮箱
     * @var
     */
    public $email;

    /**
     * 主题
     * @var
     */
    public $subject;

    /**
     * 邮件内容
     * @var
     */
    public $body;


    /**
     * 执行队列
     * @param \yii\queue\Queue $queue
     */
    public function execute($queue)
    {
        (new SendEmail([
            'subject' => $this->subject,
            'to' => $this->email,
            'body' => $this->body
        ]))->handle();
    }
}