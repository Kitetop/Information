<?php

namespace App\Service\Formatdata;

use Mx\Service\ServiceAbstract;
use App\Biz\Theme;

/**
 * Class WordResult
 * @package App\Service\Formatdata
 * @return 词频信息，数组类型
 *
 * 根据传递过来的文本信息调用分词服务从而计算出词频
 */
class WordResult extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        /**
         * $this->content 的数据结构是:
         * $this->content['content'] = 文本内容
         * $this->paragraph 的数据结构是:
         * $this->paragraph [$key]['paragraph'] = 文本内容
         */
        //$content 是一个一维数组，存储了关键词以及频度
        $compare = 0;
        $valueKey = 0;
        $content = $this->call('Formatdata\PullWord', [
            'text' => $this->content['content'],
        ]);
        var_dump($content);
        foreach ($this->paragraph as $key => $value) {
            if ($value['paragraph'] == '') {
                continue;
            }
            $paragraph = $this->call('Formatdata\PullWord', [
                'text' => $value['paragraph'],
            ]);
            $temp = $this->call('Formatdata\Compare', [
                'content' => $content,
                'paragraph' => $paragraph,
            ]);
            //存储比较值
           if($compare  < $temp){
               $compare = $temp;
               $valueKey = $key;
           }
        }
        //此时$compare的值存储选中的段落信息
        $theme = new Theme();
        $theme->articleId = $this->id;
        $theme->url = $this->url;
        $theme->title = $this->title;
        $theme->paragraph = $this->paragraph[$valueKey]['paragraph'];
        //点击量
        $theme->count = 0;
        //是否编辑字段
        $theme->edit = false;
        //相关度
        $theme->degree = $compare;
        $theme->save();
        $this->object->format = true;
        $this->object->save();
    }
}