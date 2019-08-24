<?php
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/24
 * Time: 17:33
 */

namespace App\Task\Task;

use App\Model\Entity\Goods;
use Swoft\Task\Annotation\Mapping\Task;

/**
 * @Task(name="orders")
 * Class OrderTask
 * @package App\Task\Task
 */
class OrderTask
{
    public function test($content)
    {
        sleep(3);
        $attributes = [
            'content' => $content,
            'price' => mt_rand(1, 100),
            'goods_name' => '哇哈哈',
        ];
        $good = Goods::new($attributes);

        $result3 = $good->save();

        echo "数据" . json_encode($result3) . "插入数据库成功" . PHP_EOL;
    }
}