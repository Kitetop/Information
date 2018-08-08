<?php
/**
 * 对于时间进行处理的一个公共类
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/8
 */

namespace App\Service\Common;


use MongoDB\BSON\UTCDateTime;
use Mx\Service\ServiceAbstract;

/**
 * Class TimeDeal
 * @package App\Service\Common
 * @return double $time 单位为小时
 */

class TimeDeal extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $first = $this->time->toDateTime();
        $second = new UTCDateTime();
        $second = $second->toDateTime();
        $diff = $second->diff($first);
        $time = $diff->format('%a') * 24
            + $diff->format('%h')
            + $diff->format('%i') / 60
            + $diff->format('%s') / 3600;
        return $time;
    }

}