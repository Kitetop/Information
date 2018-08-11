<?php
/**
 * 进行推荐的配置文件，限定了一次提取的文章数量以及
 * 一次推荐的文章数量
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v0.9
 * Date: 2018/8/10
 */

/**
 * 提取文章数量
 * 标准应该是根据每一天能够爬取的文章数量来决定的
 */

$config['article'] = 20;

//推荐文章数量

$config['commend'] = 10;

return $config;