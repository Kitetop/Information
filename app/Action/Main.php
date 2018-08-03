<?php
namespace App\Action;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;
use App\Service\Exc;

/**
 * Class: Main
 *
 * 测试接口
 */
class Main extends ActionAbstract
{
    protected function handleGet()
    {
        $this->response("hello","lalalla");
    }

    protected function handlePost()
    {
        $this->response("test post");
    }
}
