<?php
namespace App\Service;

use Mx\Service\ServiceAbstract;
use QL\QueryList;
/**
 * Class CollectionYivian
 * @package App\Service
 *
 * 映维网信息采集服务
 */
class CollectionYivian extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //$service是一个二维数组，存储了提取值的url列表以及标题
        $service = $this->call('GrabSource',[
           'url' => $this->url,
           'rules' => $this->rules,
        ]);
        //var_dump($service);
        //给每一个爬取文章设置规则，可以放在循环外面，不用每次都需要重新申请然后撤销空间
        $getContent = [
            'url'=> '',
            'rules' => [

            ],
        ];
        foreach ($service as $value){


        }
        return $service;
    }
}