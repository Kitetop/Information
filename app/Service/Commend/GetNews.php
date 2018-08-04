<?php

namespace App\Service\Commend;

use Mx\Service\ServiceAbstract;
use App\Biz\Theme;

/**
 * Class GetNews
 * @package App\Service\Commend
 * @return 返回得到处理后的数组类型数据
 * 
 * 获得处理后的文章内容
 */
class GetNews extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //先只从映维网上获得新闻信息
        $result = Theme::makeDao()->page($this->page, $this->limit ?: 10)
            ->order('_id', 'DESC')
            ->find();
        $data = $result->export(function ($item) {
            return $this->getItem($item);
        });
        return $data;
    }

    //对数据进行处理，得到纯数据类型
    private function getItem($item)
    {
        $row = $item->export();
        unset($row['count']);
        unset($row['grade']);
        return $row;
    }
}