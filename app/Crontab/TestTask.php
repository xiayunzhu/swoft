<?php declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/24
 * Time: 10:49
 */

namespace App\Crontab;

use Swoft\Crontab\Annotaion\Mapping\Cron;
use Swoft\Crontab\Annotaion\Mapping\Scheduled;

/**
 * @Scheduled(name="test")
 * Class TestTask
 * @package App\Crontab
 */
class TestTask
{
    /**
     * @Cron("* * * * * *")
     */
    public function firstTask()
    {
        print_r("first task run:%s".date('Y-m-d H:i:s', time()));
    }
}
