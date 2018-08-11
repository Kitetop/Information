<?php
/**
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/11
 */

namespace App\Service\Commend;


use App\Service\Exc;
use MongoDB\BSON\UTCDateTime;
use Mx\Service\ServiceAbstract;
use App\Biz\Commend;

class SaveCommend extends ServiceAbstract
{
    protected function execute()
    {
        //清除缓存内容，消除历史数据
        Commend::makeDao()->collection()->drop();
        // TODO: Implement execute() method.
        foreach ($this->target as $key => $value) {
            try {
                $commend = new Commend();
                $commend->title = $this->data[$key]['title'];
                $commend->url = $this->data[$key]['url'];
                $commend->paragraph = $this->data[$key]['paragraph'];
                $commend->count = $this->data[$key]['count'];
                $commend->articleId = $this->data[$key]['id'];
                $commend->save();
                $object = $this->object->dao()->findOne(['id' => $this->data[$key]['id']]);
                $object->commendTime = new UTCDateTime();
                $this->object->save();
            } catch (\exception $e) {
                throw new Exc('文章推荐失败:' . $e->getMessage(), 500);
            }
        }
    }
}