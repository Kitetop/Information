<?php

namespace App\Service\Yivian;

use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use QL\QueryList;
use App\Biz\News;


/**
 * Class CollectionYivian
 * @package App\Service\Yivian
 *
 * 映维网信息采集服务
 */
class CollectionYivian extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //给每一个爬取文章设置规则
        $rules = require __DIR__ . '/config.php';
        $news = new News();
        //$service是一个二维数组，存储了提取值的url列表以及标题
        $service = $this->call('Collection\GrabSource', [
            'url' => $this->url,
            'rules' => $this->rules,
        ]);
        //如果信息为空则说明文章采集服务挂了
        if (!isset($service)) {
            throw new Exc('采集服务出错', 500);
        }
        foreach ($service as $key => $value) {
            $news = $news->dao()->findOne(['url' => $value['url'], 'name' => 'yivian']);
            if (true == $news->exist()) {
                //调用存储索引服务
                $this->addIndex($service[0]['url']);
                break;
            }
            //当页面全部都是新的内容的时候也应该存储索引
            if ($key === (count($service) - 1)) {
                //调用存储索引服务
                $this->addIndex($service[0]['url']);
            }
            $content = $this->call('Collection\GrabSource', [
                'url' => $value['url'],
                'rules' => $rules['rules'],
            ]);
            if (isset($content)) {
                continue;
            }
            $content = str_replace(PHP_EOL, '', $content[0]['content']);
            $this->call('Collection\SaveNews', [
                'name' => 'yivian',
                'url' => $value['url'],
                'title' => $value['title'],
                'content' => $content,
            ]);
        }
    }

    private function addIndex($url)
    {
        $this->call('Collection\SaveIndex', [
            'url' => $url,
            'name' => 'yivian',
        ]);
    }
}
