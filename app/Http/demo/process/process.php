<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/13
 * Time: 14:35
 */
$process = new swoole_process('callback_function', false);

$pid = $process->start();
echo $pid;
function callback_function(swoole_process $worker)
{

     $worker->exec('/home/vagrant/code', array(__DIR__.'../Server/http_server.php'));
}

swoole_process::wait();