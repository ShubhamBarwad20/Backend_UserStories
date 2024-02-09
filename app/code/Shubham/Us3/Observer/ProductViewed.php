<?php

declare(strict_types= 1);

namespace Shubham\Us3\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class ProductViewed implements ObserverInterface
{
    private $logger;
    private $observer;
    public function __construct(ObserverInterface $observer, LoggerInterface $logger)
    {
        $this->observer = $observer;
        $this->logger = $logger;
        
    }

    public function execute(Observer $observer)
    {
        $product= $observer->getEvent()->getProduct();
        $this->logger->info($product->getName());
        
    }
}