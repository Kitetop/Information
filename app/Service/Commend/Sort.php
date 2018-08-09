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

class Sort extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        foreach ($this->data as $key => $value) {
            if (isset($value['commonTime'])) {
                //对于之前已经推荐了的文章
                $common[$key] = $this->call('Common\TimeDeal',[
                    'time' => $value['commonTime'],
                    'format' => false,
                ]);
            } else if(isset($value[''])){
                $uncommon[$key] =[
                  'edit' => $value['edit'],
                  'count' => $value ['count'],
                  ''
                ];
            }
        }

    }

    private function sort($item, $common = false)
    {

    }

}