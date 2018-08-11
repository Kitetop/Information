<?php
/**
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/11
 *
 * 得到推荐的文章内容
 */

namespace App\Service\Commend;


use Mx\Service\ServiceAbstract;
use App\Biz\Commend;

class GetNews extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $config = require __DIR__ . '/config.php';
        $result = Commend::makeDao()->page($this->page, $config['commend'])
            ->order('_id', 'ASC')
            ->find();
        $data = $result->export(function ($item) {
            return $this->dataFetch($item);
        });
        return $data;
    }

    //将对象里面的数据提取为纯的数组数组类型
    private function dataFetch($item)
    {
        $row = $item->export();
        unset($row['content']);
        unset($row['url']);
        unset($row['edit']);
        unset($row['count']);
        return $row;
    }
}