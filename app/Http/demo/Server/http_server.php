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
    'document_root' => '/home/vagrant/code/Lstudy/blog/resources/views'
]);
$http->on('WorkerStart', function (swoole_server $server, $worker_id) {
    define('LARAVEL_START', microtime(true));

    require __DIR__ . '/../../vendor/autoload.php';


});
$http->on('request', function ($request, $response) {

    $app = require_once __DIR__ . '/../../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response1 = $kernel->handle(
        $request1 = Illuminate\Http\Request::capture()
    );

    $response1->send();

    $kernel->terminate($request1, $response1);
//    $res = ob_get_contents();
//     ob_end_clean();
    $response->end('s');
});
$http->start();