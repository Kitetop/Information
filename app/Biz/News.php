<?php
namespace App\Biz;

use Mx\Biz\RowGateway;

class News extends RowGateway
{
    public function getTable()
    {
        return 'news';
    }
}