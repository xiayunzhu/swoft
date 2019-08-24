<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/24
 * Time: 11:31
 */

namespace App\Task\Listener;


use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\Log\Helper\CLog;

/**
 * @Listener(event=TaskEvent::Test)
 * Class TestListener
 * @package App\Task\Listener
 */
class TestListener implements EventHandlerInterface
{
    /**
     * @param EventInterface $event
     * @throws \Swoft\Exception\SwoftException
     */
    public function handle(EventInterface $event): void
    {
        CLog::info(context()->getTaskUniqid());
    }
}