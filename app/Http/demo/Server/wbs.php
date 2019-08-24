<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/15
 * Time: 12:06
 */


//创建websocket 服务器
use App\ChatTask\ChatTask;
use Illuminate\Support\Facades\App;
use SwooleTW\Http\Server\Facades\Server;
use SwooleTW\Http\Websocket\SocketIO\Packet;

$ws = new swoole_websocket_server("0.0.0.0",8812);
// open
$ws->on('open',function($fd,$request){
    if (! $request->input('sid')) {

        $payload = json_encode(
            [
                'sid' => base64_encode(uniqid()),
                'upgrades' => [],
                'pingInterval' => Config::get('swoole_websocket.ping_interval'),
                'pingTimeout' => Config::get('swoole_websocket.ping_timeout'),
            ]
        );
        $initPayload = Packet::OPEN . $payload;
        $connectPayload = Packet::MESSAGE . Packet::CONNECT;

        App::make(Server::class)->push($fd, $initPayload);
        App::make(Server::class)->push($fd, $connectPayload);

        return true;
    }

    return false;

});
//message
$ws->on('message',function($ws,$request){
    $msg = $GLOBALS['fd'][$request->fd]['name'].":".$request->data."\n";
    if(strstr($request->data,"#name#")){//用户设置昵称
        $GLOBALS['fd'][$request->fd]['name'] = str_replace("#name#",'',$request->data);

    }else{//进行用户信息发送
        //发送每一个客户端
        foreach($GLOBALS['fd'] as $i){
            $ws->push($i['id'],$msg);
        }
    }
});
//close
$ws->on('close',function($ws,$request){
    echo "客户端-{$request} 断开连接\n";
    unset($GLOBALS['fd'][$request]);//清楚连接仓库
});
$ws->start();