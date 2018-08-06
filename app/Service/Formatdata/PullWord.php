<?php

namespace App\Service\Formatdata;

use Mx\Service\ServiceAbstract;

/**
 * Class PullWord
 * @package App\Service\Formatdata
 * @return 抽词结果
 *
 * 一个通用的分词服务，使用了第三方分词服务Pullword，一个基于深度学习的
 * 中文在线抽词服务
 */
class PullWord extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        //请求头信息
        $header = array(
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'zh-CN,zh;q=0.9',
            'Cache-Control' => 'max-age=0',
            'Connection' => 'keep-alive',
            'Accept-Charset' => 'utf-8',
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',

        );
        //Pullword Api请求格式
        $text = urlencode(trim($this->text));
        $url = 'http://api.pullword.com/get.php?source=' . $text . '&param1=1&param2=1&json=0';
        $source = curl_init();
        curl_setopt($source, CURLOPT_URL, $url);
        curl_setopt($source, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($source, CURLOPT_HEADER, false);
        curl_setopt($source, CURLOPT_HTTPHEADER, $header);
        $message = curl_exec($source);
        curl_close($source);
        //将抽词结果数据结构改成一个一维数组
        return array_count_values(explode(':1', trim($message)));
    }
}