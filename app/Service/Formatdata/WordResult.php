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
         * $this->content 的数据结构是:
         * $this->content['content'] = 文本内容
         * $this->paragraph 的数据结构是:
         * $this->paragraph [$key]['paragraph']
         */
        $content = $this->call('Formatdata\PullWord',[
            'text' => $this->content['content'],
        ]);
        var_dump($content);
        exit();
    }
}