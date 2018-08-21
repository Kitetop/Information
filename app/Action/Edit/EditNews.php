<?php
/**
 * 获得需要编辑 | 已经编辑的文章段落
 * 修改文章的提取内容
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/8
 */

namespace App\Action\Edit;


use Mx\Http\ActionAbstract;
use Mx\Helper\Page;
use MongoDB\BSON\ObjectId;

class EditNews extends ActionAbstract
{
    protected $getRules = [
        'edit' => [
            'desc' => '文章是否已经修改',
            'default' => false,
        ],
        'page' => [
            'desc' => '分页页码',
            'message' => '页码错误',
            'rules' => ['Logic:gte:0'],
            'default' => 1

        ],
        'limit' => [
            'desc' => '每一页的数据存储',
            'rules' => ['Logic:gte:0'],
            'default' => 5
        ],
    ];
    protected $postRules = [
        'id' => [
            'desc' => '需要修改的文章id',
            'message' => '编号格式不正确',
            'rules' => ['required', 'mongoid'],
        ],
        'paragraph' => [
            'desc' => '修改后的提取段落信息',
            'message' => '无效的提交',
            'rules' => ['required'],
        ],
    ];

    protected function handleGet()
    {
        $this->validate($this->getRules);
        //调用查询文章是否编辑的服务
        $edit = $this->service('Edit\EditNews');
        $edit->page = $this->props['page'];
        $edit->limit = $this->props['limit'];
        $edit->edit = isset($this->props['edit']) ? true : false;
        $result = $edit->run();
        $url = $this->config('realUrl') . 'edit?';
        list($result['prev'], $result['next']) = Page::simple($result['meta'], $url, $this->props);
        $result['list'] = (array)$result['list'];
        unset($result['meta']);
        //todo 返回格式待定，需要返回文章的id
        $this->response($result);
        $this->code(200);
    }

    protected function handlePost()
    {
        $this->validate($this->postRules);
        $edit = $this->service('Edit\ChangeParagraph');
        $edit->id = $this->props['id'];
        $edit->paragraph = $this->props['paragraph'];
        $result = $edit->run();
        $this->response('paragraph', $result->paragraph);
        $this->code(200);

    }
}