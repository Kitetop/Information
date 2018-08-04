<?php

namespace App\Service\Formatdata;

use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use QL\QueryList;

/**
 * Class GetContent
 * @package App\Service\Formatdata
 * @return 提取的文本、段落信息，返回一个二维数组
 *
 * 对文本内容进行清理、提取段落信息的公用服务
 */
class GetContent extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $ql = QueryList::html($this->object->content)->rules($this->content)->query();
        //存储文章的文本信息
        $message[] = $ql->getData()->all();
        $ql = QueryList::html($this->object->content)->rules($this->paragraph)->query();
        //存储文本的段落信息
        $message[] = $ql->getData()->all();
        return $message;
    }
}