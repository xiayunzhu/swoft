<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/13
 * Time: 13:52
 */

require "AbstractPool.php";

class MysqlPoolCoroutine extends AbstractPool
{
    protected $dbConfig = array(
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'homestead',
        'password' => 'secret',
        'database' => 'blog',
        'charset' => 'utf8',
        'timeout' => 10,
    );
    public static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new MysqlPoolCoroutine();
        }
        return self::$instance;
    }

    protected function createDb()
    {
        $db = new Swoole\Coroutine\Mysql();
        $db->connect(
            $this->dbConfig
        );
        return $db;
    }
}

$httpServer = new swoole_http_server('0.0.0.0', 9501);
$httpServer->set(
    ['worker_num' => 1]
);
$httpServer->on("WorkerStart", function () {
    //MysqlPoolCoroutine::getInstance()->init()->gcSpareObject();
    MysqlPoolCoroutine::getInstance()->init();
});

$httpServer->on("request", function ($request, $response) {
    $db = null;
    $obj = MysqlPoolCoroutine::getInstance()->getConnection();
    if (!empty($obj)) {
        $db = $obj ? $obj['db'] : null;
    }
    if ($db) {
        $db->query("select sleep(2)");
        $ret = $db->query("select * from guestbook limit 1");
        MysqlPoolCoroutine::getInstance()->free($obj);
        $response->end(json_encode($ret));
    }
});
$httpServer->start();