<?php
 namespace App\Service;

 use Mx\Service\ServiceAbstract;

 /**
  * Class Collection
  * @package App\Service
  *
  * 循环遍历配制文件中的url相关配置，并根据相关的配置项调用相关服务
  * 使用简单工厂模式，实现代码复用以及结构的清晰,对于增加配置也比较方便，不用
  * 大幅度修改原有代码
  */

 class Collection extends ServiceAbstract
 {
     protected function execute()
     {
         // TODO: Implement execute() method.
         foreach ($this->host as $key =>$value){
             switch ($key){
                 case 'yivian':
                     $service = $this->call('CollectionYivian',[
                         'url' => $value['url'],
                         'rules' => $value['rules'],
                     ]);
                     return $service;
                     break;
                 case 'chinaar':
                     $service = $this->call('CollectionChinaar');
                     $service -> url = $value['url'];
                     $service -> rule = $value['rules'];
                     break;
             }
     }
     }

 }