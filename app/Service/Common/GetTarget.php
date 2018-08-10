<?php
/**
 * 获得排序指标的服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/10
 */

namespace App\Service\Common;

use Mx\Service\ServiceAbstract;

/**
 * 暂时被弃用
 *
 * Class GetTarget
 * @package App\Service\Common
 * @param Array $this ->data 提取数据来源
 * @param Array $this ->key 需要提前指标的数组索引
 */
class GetTarget extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        foreach ($this->data as $key => $value) {
            foreach ($this->key as $item) {
                $index [$key] = [$item => $value[$item]];
            }
        }
        return $index;
    }
}