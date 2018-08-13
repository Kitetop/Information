<?php
/**
 * 根据传入的文章id获得文章的详细内容
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/13
 */

namespace App\Action\Commend;


use Mx\Http\ActionAbstract;
use MongoDB\BSON\ObjectId;

class GetDetails extends ActionAbstract
{
    private $getRules = [
        'id' => [
            'desc' => '需要查看的文章的id',
            'message' => '无效的文章编号',
            'rules' => ['required', 'mongoid'],
        ],
    ];

    protected function handleGet()
    {
        $this->validate($this->getRules);
        $service = $this->service('Commend\GetDetails');
        $service->id = $this->props['id'];
        $details = $service->run();
        $this->response('content', $details->content);
        $this->response('url', $details->url);
        $this->response('title', $details->title);
        $this->code(200);
    }
}