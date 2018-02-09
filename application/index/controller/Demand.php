<?php
/**
 * @Author: Marte
 * @Date:   2018-01-25 17:46:09
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-02-09 16:56:26
 */
namespace app\index\controller;
use app\admin\Controller;
use think\Session;

use app\common\model\Cases as C;
use app\common\model\Type as T;
use app\common\model\Specific as S;
use app\common\model\System as SY;
use app\common\model\CasesOrder as CO;
use app\common\model\DemandType as DT;
use app\common\model\DemandTrade as DTR;

/**
* 案例
*/
class Demand extends Yang
{
    public function publish()
    {
        if ($this->request->isAjax()) {

        }else{
            $demandtrade = DTR::select();
            $demandtype = DT::select();
            $this->assign('demandtrade',$demandtrade);
            $this->assign('demandtype',$demandtype);
            return $this->fetch();
        }
    }

}