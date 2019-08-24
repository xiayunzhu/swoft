<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/12
 * Time: 17:15
 */

class ws
{
    const host = '0.0.0.0';
    const POST = 8812;
    public $ws = null;

    public function __construct()
    {

        $this->ws = new Swoole\WebSocket\Server("0.0.0.0", 8812);
        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2,
        ]);
        $this->ws->on('open', function ($ws, $request) {
            var_dump($request->fd);
            if ($request->fd == 1) {
                Swoole\Timer::tick(1000, function ($timer_id) {
                    echo "2s:timeId:{$timer_id}";
                });

            }
        });
        $this->ws->on('message', function ($ws, $frame) {

            echo "ser-push-message:{$frame->data}\n";
            $data = [
                'task' => 1,
                'fd' => $frame->fd,
            ];
            //不会等待task运行完了之后再运行余下代码
            $task_id = $this->ws->task($data, 0);
            //异步执行，类似task机制
            Swoole\Timer::after(1000, function () use ($ws, $frame) {
                echo "5s-after\n";
                $ws->push($frame->fd, "server-push" . date('Y-m-d H:i:s'));
            });

            $ws->push($frame->fd, 'server-push' . date('Y-m-d'));
        });
//        $this->ws->on('Task', function (Swoole\Server $serv, $task_id, $from_id, $data) {
//            echo "Tasker进程接收到数据";
//            echo "#{$serv->worker_id}\tonTask: [PID={$serv->worker_pid}]: task_id=$task_id, data_len=".strlen($data).".".PHP_EOL;
//            $serv->finish($data);
//        });
        $this->ws->on('task', function ($serv, $taskId, $workerId, $data) {
            var_dump('d');
            print_r($data);
            //耗时场景
            sleep(10);
            $serv->finish($data);
        });
        $this->ws->on('finish', function ($serv, $taskId, $data) {
            echo "taskId:{$taskId}\n";
            echo "finish-data-sucess";
        });
        $this->ws->on('close', function ($ws, $fd) {
            echo 'close';
        });
        $this->ws->start();
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        var_dump($request->fd);
    }

    public function onMessage($ws, $frame)
    {
        echo "ser-push-message:{$frame->data}\n";
        $ws->push($frame->fd, 'server-push' . date('Y-m-d'));
    }

    public function onClose($ws, $fd)
    {
        echo 'close';
    }
}

$ob = new ws();