<?php

declare (strict_types= 1);

namespace Shubham\Us4\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\RouterList;

class AvailableRoutesLogger implements ObserverInterface
{
    protected $logger;
    protected $routerList;

    public function __construct(LoggerInterface $logger, RouterList $routerList)
    {
        $this->routerList = $routerList;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $availableRouters = [];
        foreach ($this->routerList as $router) {
            $availableRouters[] = get_class($router);
        }

        $this->logger->info('Available Routers: ' . implode(', ', $availableRouters));
    }
}