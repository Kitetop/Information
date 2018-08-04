<?php

namespace App\Service\Yivian;

use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use QL\QueryList;
use App\Biz\YivianNews;

/**
 * Class GetContent
 * @package App\Service\Formatdata
 * @return
 *
 * 映维网的文章处理服务
 */
class GetContent extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $content = (new YivianNews())->dao()->findOne(['format' => false]);
        if (false == $content->exist()) {
            throw new Exc('没有更多文章需要处理了哦');
        }
        $result = $this->call('Formatdata\GetContent', [
            'object' => $content,
            'content' => $this->content,
            'paragraph' => $this->paragraph,
        ]);
        //调用分词服务,传递文本信息
        $this->call('Formatdata\PullWord',[
            'data' => $result,
        ]);
    }
}