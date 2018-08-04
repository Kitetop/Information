<?php
namespace App\Biz;

use Mx\Biz\RowGateway;

/**
 * Class YivianNews
 * @package App\Biz
 *
 * 用来存取爬取到映维网的文章
 */
class YivianNews extends RowGateway
{
    public function getTable()
    {
        return 'yivian';
    }
}