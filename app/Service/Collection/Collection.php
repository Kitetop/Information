<?php

namespace App\Service\Collection;

use Mx\Service\ServiceAbstract;

/**
 * Class Collection
 * @package App\Service\Collection
 *
 * 循环遍历配制文件中的url相关配置，并根据相关的配置项调用相关服务
 * 使用简单工厂模式，实现代码复用以及结构的清晰,对于增加配置也比较方便，不用
 * 大幅度修改原有代码
 * 收集文章的入口文件
 */
class Collection extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        foreach ($this->host as $key => $value) {
            switch ($key) {
                case 'yivian':
                    $this->call('Yivian\CollectionYivian', [
                        'url' => $value['url'],
                        'rules' => $value['rules'],
                    ]);
                    break;
                case 'chinaar':
                    $this->call('Chinaar\CollectionChinaar',[
                        'url' => $value['url'],
                        'rules' => $value['rules'],
                    ]);
                    break;
            }
        }
    }

}