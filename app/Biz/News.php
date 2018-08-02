<?php
namespace App\Biz;

use Mx\Biz\RowGateway;

class Biz extends RowGateway
{
    public function getTable()
    {
        return 'news';
    }
}