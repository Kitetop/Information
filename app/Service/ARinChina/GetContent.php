<?php
/**
 * ARinChina文章处理服务
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

namespace App\Service\ARinChina;


use App\Biz\ARinChinaNews;
use Mx\Service\ServiceAbstract;

class GetContent extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $content = (new ARinChinaNews())->dao()->findOne(['format' => false]);
        if (false == $content->exist()) {
            return false;
        }
        $result = $this->call('Formatdata\GetContent', [
            'object' => $content,
            'content' => $this->content,
            'paragraph' => $this->paragraph,
        ]);
        //传递文本信息,得到词频信息
        $this->call('Formatdata\WordResult', [
            'object' => $content,
            'content' => $result[0][0],
            'paragraph' => $result[1],
            'url' => $content->url,
            'title' => $content->title,
            'from' => 'arinchina',
        ]);
        return true;
    }
}