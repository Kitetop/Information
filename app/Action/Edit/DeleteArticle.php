<?php
/**
 * 删除相关度不高的文章
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/14
 */

namespace App\Action\Edit;


use Mx\Http\ActionAbstract;
use MongoDB\BSON\ObjectId;

class DeleteArticle extends ActionAbstract
{
    private $getRule = [
        'id' => [
            'desc' => '需要删除的文章的id',
            'message' => '无效的编号',
            'rules' => ['required', 'mongoid'],
        ],
    ];

    protected function handleGet()
    {
        $this->validate($this->getRule);
        $service = $this->service('Edit\DeleteArticle');
        $service->id = $this->props['id'];
        $service->run();
        $this->code(204);
    }
}