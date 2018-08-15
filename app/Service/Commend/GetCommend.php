<?php

namespace App\Service\Commend;

use Mx\Service\ServiceAbstract;
use App\Biz\Theme;

/**
 * Class GetCommend
 * @package App\Service\Commend
 * @return 返回得到处理后的数组类型数据
 *
 * 将文章存入推荐表
 */
class GetCommend extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $theme = new Theme();
        $config = require __DIR__ . '/config.php';
        $result = Theme::makeDao()->page(1, $config['article'])
            ->order('collectionTime', 'DESC')
            ->find();
        $data = $result->export(function ($item) {
            return $this->dataFetch($item);
        });
        //返回确定文章排序的指标排行
        $target = $this->call('Commend\GetTarget', [
            'data' => $data['list'],
            'commend' => $config['commend'],
        ]);
        $this->call('Commend\SaveCommend', [
            'target' => $target,
            'data' => $data['list'],
            'object' => $theme,
        ]);
    }

    //对数据进行处理，得到纯数据类型
    private function dataFetch($item)
    {
        $row = $item->export();
        unset($row['content']);
        unset($row['from']);
        return $row;
    }
}