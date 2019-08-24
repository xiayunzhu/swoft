<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 16:44
 */
$server = new Swoole\WebSocket\Server("0.0.0.0", 8812);

$server->set([
    'enable_static_handler'=>true,
    'document_root'=>'/home/vagrant/code/Lstudy/blog/resources/views'
]);

//监听websicket连接打开事件
$server->on('open', 'onOpen');
function onOpen($server, $request)
{
    print_r($request->fd);
}
//监听websicket消息事件
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();