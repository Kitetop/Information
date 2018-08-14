<?php
/**
 * 删除文章的服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/14
 */

namespace App\Service\Edit;


use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use App\Biz\Theme;

class DeleteArticle extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $theme =new Theme(['id' => $this->id]);
        if(false == $theme->exist()) {
            throw new Exc('此文章不存在',400);
        }
        try {
            $theme->remove();
        }catch (\exception $e) {
            throw new Exc('文章删除失败，请稍后再试');
        }
    }
}