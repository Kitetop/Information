<?php

namespace App\Biz;

use Mx\Biz\RowGateway;

class Theme extends RowGateway
{
    public function getTable()
    {
        return 'theme';
    }
    
}