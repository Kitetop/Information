<?php
namespace App\Biz;

use Mx\Biz\RowGateway;

class YivianNews extends RowGateway
{
    public function getTable()
    {
        return 'yivian';
    }
    public function save()
    {
        $this->count = 0;
        //优先级字段
        $this->grade = 0;
        parent::save();
    }
}