<?php
/**
 * 增加点击数量服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

namespace App\Service\User;


use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use App\Biz\Theme;

class AddCount extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $theme = new Theme(['id' => $this->id]);
        if (false == $theme->exist()) {
            throw new Exc('此文章不存在', 400);
        }
        try {
            $theme->count += 1;
            $theme->save();
        } catch (\exception $e) {
            throw new Exc('增加文章的点击次数失败:' . $e->getMessage(), 500);
        }
        return $theme->count;
    }
}