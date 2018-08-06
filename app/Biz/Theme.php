<?php

namespace App\Biz;

use Mx\Biz\RowGateway;

/**
 * Class Theme
 * @package App\Biz
 *
 * 用来存储提取内容后的文章内容
 */

class Theme extends RowGateway
{
    public function getTable()
    {
        return 'theme';
    }
    
}