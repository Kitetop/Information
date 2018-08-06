<?php

namespace App\Service\Formatdata;

use Mx\Service\ServiceAbstract;

/**
 * Class Compare
 * @package App\Service\Formatdata
 * @return 一个代表相关度的浮点数
 *
 * 文章与段落的相关度对比服务,使用空间向量模型算法，根据余弦值的大小来确定相关度
 */
class Compare extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //分子
        $numerator = 0;
        //段落的模
        $p = 0;
        //文章的模
        $c = 0;
        foreach ($this->content as $key => $value) {
            //检测段落中是否含有此关键字,段落中有这个关键字
            if (isset($this->paragraph[$key])) {
                $numerator += $value * $this->paragraph[$key];
                $p += $this->paragraph[$key] * $this->paragraph[$key];
            }
            $c += $value * $value;
        }
        $denominator = sqrt($p) * sqrt($c);
        return $numerator / $denominator;
    }
}