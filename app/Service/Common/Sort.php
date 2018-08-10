<?php
/**
 * 排序的公共服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release:
 * Date: 2018/8/10
 */

namespace App\Service\Common;


use Mx\Service\ServiceAbstract;

class Sort extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        if ($this->order === 'DESC') {
            arsort($this->data);
            return $this->data;
        } else {
            asort($this->data);
            return $this->data;
        }
    }
}