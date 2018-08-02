<?php
namespace App;

$host ['yivian'] = [
    'url' => 'https://yivian.com/news',
    'rules' => [
        'url' => ['h2.post-title a','href'],
        'title' => ['h2.post-title','text']
    ],
];
 return $host;