<?php
namespace app\common\validate;

use think\Validate;

class Specific extends Validate
{
    protected $rule = [
        "name|功能名称" => "require",
    ];
}
