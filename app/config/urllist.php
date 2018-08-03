<?php
namespace App;

/**
 * 爬取网站的配置信息以及筛选信息的规则
 */
$host ['yivian'] = [
    'url' => 'https://yivian.com/news',
    'rules' => [
        'url' => ['h2.post-title a','href'],
        'title' => ['h2.post-title','text']
    ],
];
 return $host;