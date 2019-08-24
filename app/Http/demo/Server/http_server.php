<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 16:14
 */
$http = new swoole_http_server('0.0.0.0', 8811);
$http->set([
    'enable_static_handler' => true,
    'document_root' => '/home/wwwroot/swoft/app/Http/demo/Server'
]);
$http->on('WorkerStart', function (swoole_server $server, $worker_id) {
    define('LARAVEL_START', microtime(true));


});
$http->on('request', function ($request, $response) {


    $response->end('s');
});
$http->start();