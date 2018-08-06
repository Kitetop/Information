<?php

namespace App\Service\Formatdata;

use Mx\Service\ServiceAbstract;

/**
 * Class WordResult
 * @package App\Service\Formatdata
 * @return 词频信息，数组类型
 *
 * 根据传递过来的文本信息调用分词服务从而计算出词频
 */
class WordResult extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        /**
         * $content以及$paragraph 的数据结构都是一个一维数组
         * 存储了关键词以及关键词出现的频率
         */
        $content = $this->call('Formatdata\PullWord',[
            'text' => $this->content['content'],
        ]);
        //对数组开始进行统计
        var_dump($content);
        exit();
    }
}