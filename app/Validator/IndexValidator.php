<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: ML-06
 * Date: 2019/8/23
 * Time: 18:01
 */

namespace App\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 *  @Validator()
 * Class IndexValidator
 * @package App\Validator\Goods
 */
class IndexValidator
{
    /**
     * @IsInt(message="type must Integer")
     * @var int
     */
    protected $name = 'defualtName';
}