<?php

namespace Shubham\Us4\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogAvailableRouter implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $logFile = BP . '/var/log/custom.log';
        $logger = new Logger('custom');
        $logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));

        $logger->info(print_r($observer, true));

        $this->logger->info('Available routers: ' . print_r($observer->getAvailableRouters(), true));
    }

}