<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/23
 * Time: 17:32
 */

namespace App\Http\Controller;

use Swoft\Bean\BeanFactory;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Task\Task;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * @Controller()
 * Class GoodController
 * @package App\Http\Controller
 */
class GoodController
{
    /**
     * 验证TestValidator验证器中的所有已定义字段
     *
     * @RequestMapping()
     * @Validate(validator="IndexValidator")
     * @param Request $request
     *
     * @return array|object|null
     */
    public function index(Request $request)
    {
        return $request->getParsedBody();
    }

    /**
     * @RequestMapping()
     */
    public function task()
    {
        $crontab = BeanFactory::getBean("crontab");
        $crontab->execute("test", "firstTask");
    }

    /**
     *@RequestMapping()
     * @throws \Swoft\Task\Exception\TaskException
     */
    public function Async()
    {
        Task::async("orders", 'test', [12345]);
        return '异步任务';
    }
}
