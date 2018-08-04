<?php

/**
 * 映维网文章匹配规则
 */

$rules ['rules'] = [
    'content' => ['div.entry-inner',
        'html',
        '-img
        -nav
        -a
        -div.code-block 
        -blockquote 
        -p:first'],
];

/**
 * 映维网内容提取规则
 */

$rules ['content'] = [
    'content' => [
      '',
      'text',
    ],
];

/**
 * 映维网段落匹配规则
 */

$rules ['paragraph'] = [
    'paragraph' => [
        'p',
        'text',
    ]
];

return $rules;