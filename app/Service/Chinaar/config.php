<?php
/**
 * ChinaAr 文章匹配规则
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

$rules ['rules'] = [
    'content' => ['div.article-content',
        'html',
        '-img
        -a
        -div.bjh-image-helper
        -p.bjh-image-caption
        -p.img-container'],
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