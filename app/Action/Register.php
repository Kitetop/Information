<?php
///**
// * User: Kitetop
// * Date: 2018/7/10
// * Time: 11:42
// */
//
//namespace App\Action;
//
//
//use Mx\Http\ActionAbstract;
//use Mx\Http\HttpFaultExc;
//class Register extends ActionAbstract
//{
//    protected $postRules = [
//        'username' => [
//            'desc' => '用户名',
//            'rules' => ['required'],
//            'message' => '不能为空'
//        ],
//        'password' => [
//            'desc' => '用户密码',
//            'rules' => ['required'],
//        ],
//    ];
//
//    protected function handlePost()
//    {
//       $this->validate($this->postRules);
//        if (!isset($this->props['username'])
//            || !isset($this->props['password'])
//        ) {
//            throw new HttpFaultExc("用户名和密码一定不能为空",403);
//        }
//        $service=$this->service('UserCreate');
//        $service->username=$this->data('username');
//        $service->password=$this->props['password'];
//        $service->props=['name'=>$this->props['name']];
//        $user=$service->run();
//        $url=$this->config('externalUrl').'users/'.$user->id;
//        $this->code(201);
//        $this->response('id',$user->id);
//        $this->response('uri',$url);
//    }
//}