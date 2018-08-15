<?php

namespace App;

/**
 * 爬取网站的配置信息以及筛选信息的规则
 */
$host ['yivian'] = [
    'url' => 'https://yivian.com/news',
    'rules' => [
        'url' => ['h2.post-title a', 'href'],
        'title' => ['h2.post-title', 'text']
    ],
];

$host ['chinaar'] = [
    'url' => 'http://www.chinaar.com/ARzx/',
    'rules' => [
        'url' => ['h2.media-heading a','href'],
        'title' => ['h2.media-heading', 'text'],
    ],
];

$host ['arinchina'] = [
  'url' => 'http://www.arinchina.com/news/',
  'rules' => [
    'url' => ['div.wzxq li.wzbt a','href'],
    'title' =>['div.wzxq li.wzbt', 'text'],
  ],
];
return $host;