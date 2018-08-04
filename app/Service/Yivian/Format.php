<?php

namespace App\Service\Yivian;

use Mx\Service\ServiceAbstract;

/**
 * Class Format
 * @package App\Service\Yivian
 *
 * 映维网文章数据处理的入口文件
 */
class Format extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //获得格式数据的配置信息
        $rules = require __DIR__ . '/config.php';
        $content = $rules['content'];
        $paragraph = $rules['paragraph'];
        //传递配置信息
        $this->call('Yivian\GetContent', [
            'content' => $content,
            'paragraph' => $paragraph,
        ]);
    }
}