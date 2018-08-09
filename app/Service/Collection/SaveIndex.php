<?php

namespace App\Service\Collection;

use App\Service\Exc;
use Mx\Service\ServiceAbstract;
use App\Biz\News;

/**
 * Class SaveIndex
 * @package App\Service\Collection
 *
 * 存储上次爬取存储的索引，方便及时阻断
 */
class SaveIndex extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        try {
            $index = new News(['name' => $this->name]);
            if (false == $index->exist()) {
                (new News())->import([
                    'name' => $this->name,
                    'url' => $this->url,
                ])->save();
            } else {
                $index->url = $this->url;
                $index->save();
            }
        } catch (\exception $e) {
            throw new Exc('文章索引存储失败:'.$e->getMessage(),500);
        }
    }
}