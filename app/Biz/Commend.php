<?php
/**
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/11
 *
 * 存储每日的推荐文章
 */

namespace App\Biz;


use Mx\Biz\RowGateway;

class Commend extends RowGateway
{
    public function getTable()
    {
        return 'commend';
    }
}