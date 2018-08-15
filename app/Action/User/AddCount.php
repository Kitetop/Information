<?php
/**
 * 在用户点击之后,增加点击数量
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

namespace App\Action\User;


use Mx\Http\ActionAbstract;
use MongoDB\BSON\ObjectId;

class AddCount extends ActionAbstract
{
    private $getRules = [
        'id' => [
            'desc' => '用户点击的文章的编号',
            'message' => '无效的编号',
            'rules' => ['required', 'mongoid'],
        ]
    ];

    protected function handleGet()
    {
        $this->validate($this->getRules);
        $service = $this->service('User\AddCount');
        $service->id = $this->props['id'];
        //返回此文章的点击次数
        $result = $service->run();
        $this->response('count', $result);
        $this->code(200);
    }
}