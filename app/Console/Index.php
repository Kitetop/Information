<?php

namespace App\Console;

use Mx\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Index
 * @package App\Console
 *
 * 项目入口文件
 */
class Index extends CommandAbstract
{
    private $host;

    public function __construct($host)
    {
        $this->host = $host;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('start')->setDescription('开始抓取');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // 调用采集服务
        $collection = $this->service('Collection\Collection');
        $collection->host = $this->host;
        $collection->run();
        //调用提取服务
        $format = $this->service('Formatdata\Format');
        $format->host = $this->host;
        $format->run();
    }
}
