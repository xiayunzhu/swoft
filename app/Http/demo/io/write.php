<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 19:05
 */
use Swoole\Coroutine as co;
$filename = __DIR__ . "/2.txt";
co::create(function () use ($filename)
{
    $r =  co::writeFile($filename,"hello swoole!");
    var_dump($r);
});