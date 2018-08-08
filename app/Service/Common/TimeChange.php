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
 * @return string 'd-h-m' | 'h-m'
 */

class TimeChange extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        if ($this->time > 24) {
            $d = floor($this->time / 24);
            $h = $this->time % 24;
            $m = floor(($this->time - $d * 24 - $h) * 60);
            return $d.'-'.$h.'-'.$m;
        } else {
            $h = floor($this->time);
            $m = floor(($this->time - $h)*60);
            return $h.'-'.$m;
        }
    }

}