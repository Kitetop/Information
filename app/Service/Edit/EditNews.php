<?php
/**
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/8
 */

namespace App\Service\Edit;


use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use App\Biz\Theme;

class EditNews extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $theme = new Theme(['id' => $this->id]);
        if(false == $theme->exist()){
            throw new Exc('无效的编号',400);
        }
        return $theme;
    }

}