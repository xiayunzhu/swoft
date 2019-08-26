<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/26
 * Time: 10:52
 */

namespace App\Aspect;

use Swoft\Aop\Annotation\Mapping\After;
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
 * @Aspect(order=2)
 *
 * 声明为 PointBean 类型的切面
 * @PointBean(include={"App\Http\Controller\TestExecTimeController"})
 */
class CalcExecTimesAspect
{
    protected $user;

    /**
     * @Before()
     */
    public function before()
    {
        $this->user = 'zz';
    }

    /**
     * @After()
     * @param JoinPoint $joinPoint
     */
    public function after(JoinPoint $joinPoint)
    {
        $method = $joinPoint->getMethod();
        echo "{$method} 方法，用用户为: {$this->user}ms\n";
    }
}