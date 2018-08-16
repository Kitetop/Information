<?php
/**
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/8
 */

namespace App\Service\Edit;


use App\Biz\Theme;
use App\Service\Exc;
use MongoDB\BSON\UTCDateTime;
use Mx\Service\ServiceAbstract;

class ChangeParagraph extends ServiceAbstract
{
    /**
     * @throws Exc
     * @return Object Theme
     *
     * 将修改后的文章的段落存储到数据库中
     */
    protected function execute()
    {
        // TODO: Implement execute() method.
        $theme = new Theme(['id' => $this->id]);
        if (false == $theme->exist()) {
            throw new Exc('无效的编号', 400);
        }
        $theme->paragraph = $this->paragraph;
        $theme->edit = true;
        $theme->changeTime = new UTCDateTime();
        return $theme->save();

    }

}