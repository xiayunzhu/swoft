<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/26
 * Time: 10:40
 */

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller()
 * Class TestExecTimeController
 * @package App\Http\Controller
 */
class TestExecTimeController
{
    /**
     * 闭包递归 计算阶乘
     *
     * @RequestMapping(route="test/{number}")
     *
     * @param int $number
     *
     * @return array
     */
    public function factorial(int $number): array
    {
        $factorial = function ($arg) use (&$factorial) {
            if ($arg == 1) {
                return $arg;
            }

            return $arg * $factorial($arg - 1);
        };

        return [$factorial($number)];
    }

    /**
     * 计算1～1000的和，最后休眠1s
     *
     * @RequestMapping()
     */
    public function sumAndSleep(): array
    {
        $sum = 0;
        for ($i = 1; $i <= 1000; $i++) {
            $sum = $sum + $i;
        }

        usleep(1000);
        return [$sum];
    }
}