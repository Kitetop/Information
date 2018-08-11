<?php
/**
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/8
 */

namespace App\Service\Common;


use Mx\Service\ServiceAbstract;

/**
 * Class TimeChange
 * @package App\Service\Common
 * @return string X天前 | X小时前 | X分钟前
 */
class TimeChange extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        if ($this->time > 24) {
            $d = floor($this->time / 24);
            if($d>99){
                return '99+ 天前';
            }
            return $d . '天前';
        } else if (floor($this->time) > 0) {
            $h = floor($this->time);
            return $h . '小时前';
        } else {
            $m = floor($this->time * 60)>0 ?floor($this->time * 60):1;
            return $m.'分钟前';
        }
    }

}