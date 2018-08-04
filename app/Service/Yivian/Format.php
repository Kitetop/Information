<?php

namespace App\Service\Yivian;

use Mx\Service\ServiceAbstract;

class Format extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //获得格式数据的配置信息
        $rules = require __DIR__ . '/config.php';
        $content = $rules['content'];
        $paragraph = $rules['paragraph'];
        //调用比较服务，传递配置信息
        $this->call('Formadata\Compare', [
            'content' => $content,
            'paragraph' => $paragraph,
        ]);
    }
}