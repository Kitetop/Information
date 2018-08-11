<?php
/**
 * 给后台显示相关的待编辑 | 已编辑的文章信息
 *
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
    /**
     * @return mixed $data 存储文章信息的二维数组
     */
    protected function execute()
    {
        // TODO: Implement execute() method.
        if ($this->edit) {
            //显示已经编辑的文章
            $result = Theme::makeDao()->page($this->page, $this->limit ?: 10)
                ->order('changeTime', 'DESC')
                ->find(['edit' => true]);
            $data = $result->export(function ($item) {
                return $this->dataFetch($item);
            });
            foreach ($data['list'] as $key => $value) {
                $data['list'][$key]['changeTime'] = $this->call('Common\TimeDeal', [
                    'time' => $value['changeTime'],
                    'format' => true,
                ]);
            }
        } else {
            $result = Theme::makeDao()->page($this->page, $this->limit ?: 10)
                ->order('degree', 'ASC')
                ->find(['edit' => false]);
            $data = $result->export(function ($item) {
                return $this->dataFetch($item);
            });
        }
        return $data;
    }

    //将对象里面的数据提取为纯的数组数组类型
    private function dataFetch($item)
    {
        $row = $item->export();
        unset($row['id']);
        unset($row['collectionTime']);
        unset($row['commendTime']);
        unset($row['url']);
        unset($row['edit']);
        unset($row['count']);
        return $row;
    }

}