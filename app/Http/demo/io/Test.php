<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/13
 * Time: 13:36
 */
defined('CHANNEL_SIZE') or define('CHANNEL_SIZE', 2345);
class Test {

    public function market()
    {
        $channel = new Channel(CHANNEL_SIZE);

        go(function() use ($channel){ //此为swoole的go协程，实际是个闭包运用
            $data = $this->getMarket(); //数据集
            $channel->push($data);//将数据集插入进管道
        });

        $popData = $channel->pop();
        var_dump($popData);
    }

    public function getMarket()
    {
        return 1;
    }
}



