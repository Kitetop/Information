<?php

/**
 * 映维网文章匹配规则
 */

$rules = [
    'content' => ['div.entry-inner',
        'html',
        '-img
        -nav
        -a
        -div.code-block 
        -blockquote 
        -p:first'],
];
return $rules;