<?php
/**
 * Chinaar文章数据处理入口文件
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

namespace App\Service\Chinaar;


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
        //传递配置信息
        $bool = $this->call('Chinaar\GetContent', [
            'content' => $content,
            'paragraph' => $paragraph,
        ]);
        return $bool;

    }
}