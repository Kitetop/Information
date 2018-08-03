<?php

namespace App\Action\Commend;

use Mx\Helper\Page;
use Mx\Http\ActionAbstract;

/**
 * Class GetNews
 * @package App\Action\Commend
 *
 * 接受用户的get请求并且按默认每次返回10条新闻数据
 */
class GetNews extends ActionAbstract
{
    protected $getRules = [
        'page' => [
            'desc' => '分页页码',
            'message' => '页码错误',
            'rules' => ['Logic:gte:0'],
            'default' => 1

        ],
        'limit' => [
            'desc' => '每一页的数据存储',
            'rules' => ['Logic:gte:0'],
            'default' => 10
        ],
    ];

    protected function handleGet()
    {
        // TODO: Change the autogenerated stub
        $this->validate($this->getRules);
        $news = $this->service('Commend\GetNews');
        $news->page = $this->props['page'];
        $news->limit = $this->props['limit'];
        $result = $news->run();
        $url = $this->config('realUrl') . 'news?';
        //生成上一页下一页的跳转链接
        list($result['prev'], $result['next']) = Page::simple($result['meta'], $url, $this->props);
        $result['list'] = (array)$result['list'];
        $this->response($result);
        $this->code(200);
    }
}