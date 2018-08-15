<?php
/**
 * ChinaAr信息采集服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

namespace App\Service\Chinaar;


use App\Biz\News;
use App\Service\Exc;
use Mx\Service\ServiceAbstract;

class CollectionChinaar extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $rules = require __DIR__.'/config.php';
        $news = new News();
        $service = $this->call('Collection\GrabSource',[
           'url' => $this->url,
           'rules' => $this->rules,
        ]);
        if(!isset($service)) {
            throw new Exc('采集服务出错',500);
        }
        foreach ($service as $key => $value) {
            $news = $news->dao()->findOne(['url' => $value['url'], 'name' => 'chinaar']);
            if (true == $news->exist()) {
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
            if (!isset($content)) {
                continue;
            }
            $content = str_replace(PHP_EOL, '', $content[0]['content']);
            $this->call('Collection\SaveNews', [
                'name' => 'chinaar',
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
            'name' => 'chinaar',
        ]);
    }

}