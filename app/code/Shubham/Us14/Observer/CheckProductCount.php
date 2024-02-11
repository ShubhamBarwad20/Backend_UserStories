<?php
namespace Shubham\Us14\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class CheckProductCount implements ObserverInterface
{
    private $logger;
    /**
     * Constructor for the PHP function.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $items = $order->getAllItems();
        // Loop througs items and find products with quantity < 5
        foreach ($items as $item) {
            if ($item->getQtyOrdered() < 5) {
                $this->logger->info("Product " . $item->getName() . " has quantity less than 5. Its quantity is " . $item->getQtyOrdered());
            }
        }
    }
}
