<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/26
 * Time: 10:42
 */

namespace App\Aspect;

use Swoft\Aop\Annotation\Mapping\After;
use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\Before;
use Swoft\Aop\Annotation\Mapping\PointBean;
use Swoft\Aop\Point\JoinPoint;

/**
 * AOP切面类
 *
 * @since 2.0
 *
 * 声明切面类
 * @Aspect(order=1)
 *
 * 声明为 PointBean 类型的切面
 * @PointBean(include={"App\Http\Controller\TestExecTimeController"})
 */
class CalcExecTimeAspect
{
    protected $start;
    protected $order;

    /**
     * @Around()
     */
    public function around(){

        $this->order=1;
    }
    /**
     * 定义通知点
     * @Before()
     */
    public function before()
    {
        $this->start = microtime(true);
    }

    /**
     * 定义通知点
     * @After()
     * @param JoinPoint $joinPoint
     */
    public function after(JoinPoint $joinPoint)
    {
        $method = $joinPoint->getMethod();
        $after = microtime(true);
        $runtime = ($after - $this->start) * 1000;

        echo "{$method} 方法，本次执行时间为: {$runtime}ms\n";
    }
}