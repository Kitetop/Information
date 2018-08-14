<?php

namespace App\Kernel;

use Mx\Http\Front;
use Mx\Http\Message\Router;
use Mx\Base\Kernel\AppAbstract;

/**
 * App
 *
 * @see AppAbstract
 * @author huangjide <huangjide@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class App extends AppAbstract
{
    public function __construct()
    {
        $env = $this->getRuntimeEnvName();
        $config = require __DIR__ . '/../config/' . $env . '.php';

        parent::__construct($config);
    }

    public function run()
    {
        $router = new Router($this->routes(), $this->config['action']);
        $font = new Front($this, $router);

        $font->registerPhase(new \Mx\Http\Phase\PhaseInit());
        $font->registerPhase(new \Mx\Http\Phase\PhaseRoute());
        $font->registerPhase(new \Mx\Http\Phase\PhaseOutput());

        $font->run();
    }

    public function routes()
    {
        $routes = [
            ['path' => '/', 'action' => 'Main', 'method' => 'GET'],
            //推荐给用户
            ['path' => 'news', 'action' => 'Commend\GetNews', 'method' => 'GET'],
            ['path' => 'news/details', 'action' => 'Commend\GetDetails', 'method' => 'GET'],
            //文章的编辑,供后台使用
            ['path' => 'edit', 'action' => 'Edit\EditNews', 'method' => 'GET'],
            ['path' => 'edit', 'action' => 'Edit\EditNews', 'method' => 'POST'],
            ['path' => 'edit/delete', 'action' => 'Edit\DeleteArticle', 'method' => 'GET'],
        ];
        return $routes;
    }
}
