<?php
/**
 * 给推荐文章进行排序服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/9
 */

namespace App\Service\Commend;


use App\Service\Exc;
use MongoDB\BSON\UTCDateTime;
use Mx\Service\ServiceAbstract;

class GetTarget extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        foreach ($this->data as $key => $value) {
            if (isset($value['commonTime'])) {
                //已经推荐过的文章
                $common[$key] = ($this->call('Common\TimeDeal', [
                    'time' => $value['commonTime'],
                    'format' => false,
                ]))
                +$value['degree']
                +(isset($value['priority']) ? $value['priority'] : 0)
                +($value['edit'] ? 1 : 0);
            } else {
                //未被推荐的文章
                $primary[$key] = ($value['edit'] ? 1 : 0)
                    + (isset($value['priority']) ? $value['priority'] : 0)
                    + $value['degree'];
            }
        }
        $primary = $this->call('Common\Sort', [
            'data' => $primary,
            'order' => 'DESC',
        ]);
        if (count($primary) < $this->common) {

            $common = $this->call('Common\Sort', [
                'data' => $common,
                'order' => 'DESC',
            ]);
            $result = (isset($primary)?$primary:[]) + $common;
        } else {
            $result = $primary;
        }
        foreach ($result as $key => $value) {
            try {
                $object = $this->object->dao()->findOne(['id' => $this->data[$key]['id']]);
                $object->commonTime = new UTCDateTime();
                $object->save();
            } catch (\exception $e) {
                throw new Exc('更新推荐时间失败:' . $e->getMessage(), 500);
            }
            unset($this->data[$key]['count']);
            unset($this->data[$key]['edit']);
            unset($this->data[$key]['degree']);
            unset($this->data[$key]['collectionTime']);
            unset($this->data[$key]['changeTime']);
            unset($this->data[$key]['commonTime']);
            $data [] = $this->data[$key];
            if (count($data) == $this->common) {
                break;
            }
        }
        return $data;
    }
}