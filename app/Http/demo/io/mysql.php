<?php

/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 19:07
 */

class AysMysql
{
    public $mysql = '';
    public $dbConfig = '';

    public function __construct()
    {
        $this->mysql = new Swoole\Coroutine\MySQL();
        $this->dbConfig=[
            'host' => 'localhost',
            'port' => 3306,
            'user' => 'homestead',
            'password' => 'secret',
            'database' => 'blog',
        ];
        go(function () {
            $this->mysql->connect($this->dbConfig);
        });

    }

    public function update()
    {
    }

    public function add()
    {
    }

    /**
     * mysql的执行逻辑
     * @param $id
     * @param $username
     * @return bool
     */
    public function execute($id, $username)
    {
        go(function () {
            $res = $this->mysql->query('SELECT * FROM users WHERE id=1');
            var_dump($this->mysql);
            var_dump($res);
        });

    }
}

$obj = new AysMysql();
$obj->execute(1, '222');

