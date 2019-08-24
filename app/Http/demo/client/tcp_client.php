<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 14:21
 */
$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect("127.0.0.1", 9501)) {
    echo '连接失败';
    exit;
}
//php cli常量
fwrite(STDOUT, "请输入消息：");
$msg = trim(fgets(STDIN));

//发送消息给tcp server服务器
$client->send($msg);

$result = $client->recv();
echo $result;
