<?php

namespace App\Service\Formatdata;

use Mx\Service\ServiceAbstract;

/**
 * Class Format
 * @package App\Service\Formatdata
 *
 * 文本内容提取的入口文件
 */
class Format extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        foreach ($this->host as $key => $value) {
            switch ($key) {
                case 'yivian':
                    while ($this->call('Yivian\Format')) {
                    };
                    break;
                case 'chinaar':
                    while ($this->call('Chinaar\Format')) {
                    };
                    break;
                case 'arinchina':
                    while ($this->call('ARinChina\Format')) {
                    };
                    break;
            }
        }
    }
}