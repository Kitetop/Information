<?php
/**
 * User: Kitetop
 * Date: 2018/7/10
 * Time: 13:58
 */

namespace App\Service;


use Mx\Service\ServiceAbstract;

class UserCreate extends ServiceAbstract
{
    //用户的注册信息都会保存在$this->props之中
    protected function execute()
    {
        // TODO: Implement execute() method.
        echo $this->props['username'].'<br>';
        echo $this->props['password'].'<br>';
        exit(0);
    }

}