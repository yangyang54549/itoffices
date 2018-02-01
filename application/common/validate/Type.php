<?php
namespace app\common\validate;

use think\Validate;

class Type extends Validate
{
    protected $rule = [
        "name|产品类型" => "require",
    ];
}
