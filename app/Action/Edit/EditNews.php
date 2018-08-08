<?php
/**
 * 获得需要编辑的文章段落
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: 0.9
 * Date: 2018/8/8
 */

namespace App\Action\Edit;


use Mx\Http\ActionAbstract;
use MongoDB\BSON\ObjectId;

class EditNews extends ActionAbstract
{
    protected $getRules = [
        'id' => [
            'desc' => '需要修改的文章id',
            'message' => '编号格式不正确',
            'rules' => ['required', 'mongoid'],
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
        //调用修改文章服务
        $edit = $this->service('Edit\EditNews');
        $edit->id = $this->props['id'];
        $result = $edit->run();
        $this->response('content', $result->content);
        $this->response('paragraph', $result->paragraph);
        $this->code(200);
    }
    protected function handlePost()
    {
        $this->validate($this->postRules);
        $edit = $this->service('Edit\ChangeParagraph');
        $edit->id = $this->props['id'];
        $edit->paragraph = $this->props['paragraph'];
        $result = $edit->run();
        //Todo 返回格式待定
        $this->response('paragraph',$result->paragraph);
        $this->code(200);

    }
}