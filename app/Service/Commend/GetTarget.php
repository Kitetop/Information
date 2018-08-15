<?php
/**
 * 给推荐文章进行排序服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/9
 */

namespace App\Service\Commend;


use Mx\Service\ServiceAbstract;

class GetTarget extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $primary = [];
        $commend = [];
        foreach ($this->data as $key => $value) {
            if (isset($value['commendTime'])) {
                //已经推荐过的文章
                $commend[$key] = ($this->call('Common\TimeDeal', [
                        'time' => $value['commendTime'],
                        'format' => false,
                    ]))
                    + $value['degree']
                    + (isset($value['priority']) ? $value['priority'] : 0)
                    + ($value['edit'] ? 1 : 0);
            } else {
                //未被推荐的文章
                $primary[$key] = ($value['edit'] ? 1 : 0)
                    + (isset($value['priority']) ? $value['priority'] : 0)
                    + $value['degree'];
            }
        }
        $primary = $this->call('Common\Sort', [
            'data' => $primary,
            'order' => 'DESC',
        ]);
        $commend = $this->call('Common\Sort', [
            'data' => $commend,
            'order' => 'DESC',
        ]);
        $result = (isset($primary) ? $primary : []) + (isset($commend) ? $commend : []);
        return $result;
    }
}