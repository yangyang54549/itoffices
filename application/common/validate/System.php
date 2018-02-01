<?php
namespace app\common\validate;

use think\Validate;

class System extends Validate
{
    protected $rule = [
        "name|开发类型" => "require",
    ];
}
