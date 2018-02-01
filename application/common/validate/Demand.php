<?php
namespace app\common\validate;

use think\Validate;

class Demand extends Validate
{
    protected $rule = [
        "demand_name|需求名称" => "require",
        "money|预算金额" => "require",
        "industry|所属行业" => "require",
        "type|所属类型" => "require",
        "period|开发周期" => "require",
        "urgency|紧急程度" => "require",
        "apply|已申请人数" => "require",
        "browse|浏览人数" => "require",
        "delivery_time|交付时间" => "require",
        "schedule|项目进度" => "require",
        "info|任务详情" => "require",
        "reference|参考网站/产品" => "require",
        "authority|官方观点" => "require",
        "company_name|公司名称" => "require",
        "user_name|发布人姓名" => "require",
        "mobile|手机号码" => "require",
    ];
}
