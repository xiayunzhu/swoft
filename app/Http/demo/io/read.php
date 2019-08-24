<?php
/**
 * 异步读取文件
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 18:47
 */

use Swoole\Coroutine as co;

$filename = __DIR__ . "/1.txt";
$result = co::create(function () use ($filename) {
    $r = co::readFile($filename);
    var_dump($r);
});
var_dump($result);

