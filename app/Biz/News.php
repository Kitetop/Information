<?php
namespace App\Biz;

use Mx\Biz\RowGateway;

/**
 * Class News
 * @package App\Biz
 *
 * 用来存储最后一次爬取文章的url，方便去重
 */
class News extends RowGateway
{
    public function getTable()
    {
        return 'news';
    }
}