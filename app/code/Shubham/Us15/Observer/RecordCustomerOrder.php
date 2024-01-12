<?php

namespace Shubham\Us15\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Shubham\Us15\Model\ResourceModel\CustomGroupSalesModel;
use Psr\Log\LoggerInterface;

class RecordCustomerOrder implements ObserverInterface
{
    private $_customGroupSalesModel;
    private $_logger;
    public function __construct(CustomGroupSalesModel $customGroupSalesModel, LoggerInterface $logger)
    {
        $this->_customGroupSalesModel = $customGroupSalesModel;
        $this->_logger = $logger;
    }
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $customerGroupId = $order->getCustomerGroupId();
        $totalPurchaseAmount = $order->getGrandTotal();

        // Try updating the total purchase amount if it fails log the error
        try {
            $this->_customGroupSalesModel->updateTotalPurchaseAmount($customerGroupId, $totalPurchaseAmount);
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
        }
    }
}