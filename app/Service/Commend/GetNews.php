<?php

namespace App\Service\Commend;

use Mx\Service\ServiceAbstract;
use App\Biz\YivianNews;

class GetNews extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //先只从映维网上获得新闻信息
        $result = YivianNews::makeDao()->page($this->page, $this->limit ?: 10)
            ->order('_id', 'DESC')
            ->find();
        $data = $result->export(function ($item) {
            return $this->getItem($item);
        });
        //需要调用文本内容处理服务对文本进行格式化$data['list']内部是一个2维数组
        //存储每一个文章的标题、id以及文章内容
        return $data;
    }

    //对数据进行处理，得到纯数据类型
    private function getItem($item)
    {
        $row = $item->export();
        unset($row['url']);
        unset($row['count']);
        unset($row['grade']);
        return $row;
    }
}