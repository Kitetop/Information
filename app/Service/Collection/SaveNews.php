<?php

namespace App\Service\Collection;


use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use App\Biz\YivianNews;
use App\Biz\ChinaarNews;
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
        switch ($this->name) {
            case 'yivian':
                try {
                    (new YivianNews())->import([
                        'url' => $this->url,
                        'title' => $this->title,
                        'content' => $this->content,
                        'format' => false,
                    ])->save();
                } catch (\exception $e) {
                    throw new Exc($this->name . '新闻存入数据库失败:' . $e->getMessage(), 500);
                }
                break;
            case 'chinaar':
                try {
                    (new ChinaarNews())->import([
                        'url' => $this->url,
                        'title' => $this->title,
                        'content' => $this->content,
                        'format' => false,
                    ])->save();
                } catch (\exception $e) {
                    throw new Exc($this->name . '新闻存入数据库失败:' . $e->getMessage(), 500);
                }
                break;
        }
    }
}