<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 13:52
 */
$serv = new swoole_server('127.0.0.1', 9501);
$serv->set([
    'worker_num' => 8, //worker进程数 cpu 1-4倍
    'max_request' => 10000,
]);
//$reactor_id线程ID
//$fd 客户端连接的唯一标识
$serv->on('connect', function ($serv, $fd,$reactor_id) {
    echo "Client{$reactor_id}-{$fd}:Connect.\n";
});

//监听数据接受时间
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server:{$from_id}" . $data);
});
//监听关闭
$serv->on('close', function ($serv, $fd) {
    echo '关闭';
});
$serv->start();