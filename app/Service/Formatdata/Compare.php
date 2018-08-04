<?php

namespace App\Service\Formatdata;

use Mx\Service\ServiceAbstract;

/**
 * Class Compare
 * @package App\Service\Formatdata
 *
 * 文章对比筛选出主题相关度高的段落
 */
class Compare extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $content = $this->call('Formatdata\GetContent', [
            'rules' => $this->content,
        ]);
        $paragraph = $this->call('Formatdata\GetParagraph', [
            'rules' => $this->paragraph,
        ]);

    }
}