<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/13
 * Time: 13:13
 */
go(function () {
    $start = microtime(true);
    $db = new Swoole\Coroutine\MySQL();
    $db->connect([
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'homestead',
        'password' => 'secret',
        'database' => 'blog',
        'timeout' => 10
    ]);
    var_dump($db);
    $db->query("select sleep(5)");
    echo "我是第一个sleep五秒之后\n";
    $ret = $db->query("select * from users");#2
    var_dump($ret);
    $use = microtime(true) - $start;
    echo "协程mysql输出用时：" . $use . PHP_EOL;
});


