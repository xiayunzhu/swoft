<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/13
 * Time: 13:45
 */

require "AbstractPool.php";

class MysqlPoolPdo extends AbstractPool
{

    protected $dbConfig = array(
        'host' => 'mysql:host=127.0.0.1:3306;dbname=blog',
        'port' => 3306,
        'user' => 'homestead',
        'password' => 'secret',
        'database' => 'blog',
        'charset' => 'utf8',
        'timeout' => 2,
    );
    public static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new MysqlPoolPdo();
        }
        return self::$instance;
    }

    protected function createDb()
    {
        return new PDO($this->dbConfig['host'], $this->dbConfig['user'], $this->dbConfig['password']);
    }
}

$httpServer = new swoole_http_server('0.0.0.0', 9501);
$httpServer->set(
    ['worker_num' => 1]
);
$httpServer->on("WorkerStart", function () {
    MysqlPoolPdo::getInstance()->init();
});
$httpServer->on("request", function ($request, $response) {
    $db = null;
    $obj = MysqlPoolPdo::getInstance()->getConnection();
    if (!empty($obj)) {
        $db = $obj ? $obj['db'] : null;
    }
    if ($db) {
        $db->query("select sleep(2)");
        $ret = $db->query("select * from users limit 1");
        MysqlPoolPdo::getInstance()->free($obj);
        $response->end(json_encode($ret));
    }
});
$httpServer->start();