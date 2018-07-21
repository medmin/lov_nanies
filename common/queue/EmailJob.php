<?php

/**
 * User: xczizz
 * Date: 2018/7/15
 * Time: 1:15
 */

namespace common\queue;

use common\lib\SendEmail;
use common\models\UserNotify;
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
     * 邮件类型（比如激活，私信等等之类的）
     * @var
     */
    public $category = null;

    /**
     * 根据邮件类型来判断是否需要回调，这里保存回调的目标ID（比如私信ID）
     * @var
     */
    public $callback_id = null;


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

    /**
     * 回调执行
     * @return bool
     */
    public function callback(){
        if (!empty($this->category) && !empty($this->callback_id)) {
            $model = UserNotify::findOne($this->callback_id);
            $model->send_mail = 1;
            $model->sender_at = time();
            return $model->save();
        }
        return false;
    }
}