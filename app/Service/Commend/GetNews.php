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
        $theme = new Theme();
        $config = require __DIR__ . '/config.php';
        $result = Theme::makeDao()->page(1, $config['article'])
            ->order('collectionTime', 'DESC')
            ->find();
        $data = $result->export(function ($item) {
            return $this->dataFetch($item);
        });
        $sort = $this->call('Commend\GetTarget', [
            'data' => $data['list'],
            'common' => $config['common'],
            'object' => $theme,
        ]);
        $data['list'] = $sort;
        return $data;
    }

    //对数据进行处理，得到纯数据类型
    private function dataFetch($item)
    {
        $row = $item->export();
        unset($row['articleId']);
        unset($row['content']);
        unset($row['from']);
        return $row;
    }
}