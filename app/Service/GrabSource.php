<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use QL\QueryList;

/**
 * Class GrabSource
 * @package App\Service
 *
 * 使用CURL库爬取网页的内容
 */
class GrabSource extends ServiceAbstract
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
        $source = curl_init();
        curl_setopt($source, CURLOPT_URL, $this->url);
        curl_setopt($source, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($source, CURLOPT_HEADER, false);
        curl_setopt($source, CURLOPT_HTTPHEADER, $header);
        $message = curl_exec($source);
        curl_close($source);
        $ql = QueryList::html($message)->rules($this->rules)->query();
        $message = $ql->getData();
        return $message->all();
    }
}