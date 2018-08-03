<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use QL\QueryList;
use App\Biz\News;

/**
 * Class CollectionYivian
 * @package App\Service
 *
 * 映维网信息采集服务
 */
class CollectionYivian extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $news = new News();
        //$service是一个二维数组，存储了提取值的url列表以及标题
        $service = $this->call('GrabSource', [
            'url' => $this->url,
            'rules' => $this->rules,
        ]);
        //给每一个爬取文章设置规则
        $getContent = [
            'rules' => [
                'content' => ['div.entry-inner',
                    'text',
                    '-imag 
                    -div.code-block 
                    -blockquote 
                     -p:first'],
            ],
        ];
        foreach ($service as $key => $value) {
            $news = $news->dao()->findOne(['url' => $value['url'], 'name' => 'yivian']);
            if (true == $news->exist()) {
                //调用存储索引服务
                $this->addIndex($service[0]['url']);
                break;
            }
            //当页面全部都是新的内容的时候也应该存储索引
            if($key === (count($service) - 1)){
                //调用存储索引服务
                $this->addIndex($service[0]['url']);
            }
            $content = $this->call('GrabSource', [
                'url' => $value['url'],
                'rules' => $getContent['rules']
            ]);
            $content = str_replace(PHP_EOL, '', $content[0]['content']);
            $this->call('SaveNews', [
                'name' => 'yivian',
                'url' => $value['url'],
                'title' => $value['title'],
                'content' => $content,
            ]);
        }
    }

    private function addIndex($url)
    {
        $this->call('SaveIndex', [
            'url' => $url,
            'name' => 'yivian',
        ]);
    }
}
