<?php
namespace app\common\validate;

use think\Validate;

class Cases extends Validate
{
    protected $rule = [
        "case_name|案例名称" => "require",
        "money|案例金额" => "require",
        "images|图片集" => "require",
        "brief|简介" => "require",
        "type|案例类型" => "require",
        "specific|案例功能" => "require",
        "system_type|案例系统类型" => "require",
        "info|案例详情" => "require",
        "status|状态" => "require",
    ];
}
