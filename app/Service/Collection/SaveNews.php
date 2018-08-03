<?php
namespace App\Service\Collection;

use Mx\Service\ServiceAbstract;
use App\Biz\YivianNews;

/**
 * Class SaveNews
 * @package App\Service\Collection
 *
 * 存储信息的工厂，根据爬取名字来决定将信息存储到哪一个文档中
 */
class SaveNews extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        switch ($this->name){
            case 'yivian':
                (new YivianNews())->import([
                    'url' => $this->url,
                    'title' => $this->title,
                    'content' => $this->content,
                ])->save();
                break;
        }
    }
}