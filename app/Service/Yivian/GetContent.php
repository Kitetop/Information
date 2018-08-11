<?php

namespace App\Service\Yivian;

use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use QL\QueryList;
use App\Biz\YivianNews;

/**
 * Class GetContent
 * @package App\Service\Formatdata
 * @return false|true 代表是否美化完成
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
            return false;
        }
        $result = $this->call('Formatdata\GetContent', [
            'object' => $content,
            'content' => $this->content,
            'paragraph' => $this->paragraph,
        ]);
        //传递文本信息,得到词频信息
        $this->call('Formatdata\WordResult', [
            'object' => $content,
            'content' => $result[0][0],
            'paragraph' => $result[1],
            'url' => $content->url,
            'title' => $content->title,
            'from' => 'yivian',
        ]);
        return true;
    }
}