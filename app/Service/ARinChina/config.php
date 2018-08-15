<?php
/**
 * ARinChinaNews 文章匹配规则
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */
$rules ['rules'] = [
    'content' => ['td#article_content',
        'html',
        'p.MsoNormal
        -div#qb_collection_img_mask
        -p.last-btn
        -iframe
        -div#qb-sougou-search'],
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