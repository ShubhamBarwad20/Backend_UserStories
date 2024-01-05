<?php

declare(strict_types= 1);

namespace Shubham\Us4\App\Router;

use Magento\Framework\App\Router\NoRouteHandlerInterface;

class NoRoute implements NoRouteHandlerInterface
{
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $requestValue = ltrim($request->getPathInfo(),"/");
        $request->setParam('q', $requestValue);
        $request->setModuleName('contact')->setControllerName('index')->setActionName('index');
        return true;
    }
}