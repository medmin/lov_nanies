<?php
/**
 * User: xczizz
 * Date: 2018/7/21
 * Time: 14:00.
 */

namespace common\behaviors;

use common\queue\EmailJob;
use yii\base\Behavior;
use yii\queue\ExecEvent;
use yii\queue\Job;
use yii\queue\JobEvent;
use yii\queue\Queue;

class QueueAfterExecBehavior extends Behavior
{
    /**
     * @var Queue
     */
    public $owner;

    public function events()
    {
        return [
            Queue::EVENT_AFTER_EXEC => 'afterExec',
        ];
    }

    public function afterExec(ExecEvent $event)
    {
        if ($event->job instanceof Job && get_class($event->job) == EmailJob::class) {
            $event->job->callback();
        }
    }

    protected function getEventTitle(JobEvent $event)
    {
        $title = strtr('[id] name', [
            'id'   => $event->id,
            'name' => $event->job instanceof Job ? get_class($event->job) : 'mixed data',
        ]);
        if ($event instanceof ExecEvent) {
            $title .= " (attempt: $event->attempt)";
        }

        return $title;
    }
}
