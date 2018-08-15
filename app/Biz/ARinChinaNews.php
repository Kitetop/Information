<?php
/**
 * 用来存储从Chinanr爬取到的文章
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

namespace App\Biz;


use Mx\Biz\RowGateway;

class ARinChinaNews extends RowGateway
{
    public function getTable()
    {
        return 'arinchina';
    }
}