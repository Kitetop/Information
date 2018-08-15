<?php
/**
 * 获得推荐文章
 *
 * @author Kitetop <xieshizhen@duxze.com>
 * @version Release: v1.0
 * Date: 2018/8/15
 */

namespace App\Console;

use Mx\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Commend extends CommandAbstract
{
    protected function configure()
    {
        $this->setName('commend')->setDescription('推荐');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //调用每日文章推荐服务
        $commend = $this->service('Commend\GetCommend');
        $commend->run();
    }
}