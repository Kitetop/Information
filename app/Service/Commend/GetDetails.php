<?php
/**
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/13
 */

namespace App\Service\Commend;


use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use App\Biz\Theme;

class GetDetails extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $theme = new Theme(['id' => $this->id]);
        if(false == $theme->exist()){
            throw new Exc('此文章不存在',400);
        }
        return $theme;
    }
}