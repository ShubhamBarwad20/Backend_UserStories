<?php

 namespace Shubham\Us15\Observer;

 use Magento\Framework\Event\ObserverInterface;
 use Magento\Framework\Event\Observer;
 use Magento\Framework\Event\ManagerInterface;

 class CustomOrderPlaced implements ObserverInterface
 {
    protected $eventManager;
    public function __construct(ManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }
    public function execute(Observer $observer)
    {
        // Dispatch an event named custom_order_placement
        $this->eventManager->dispatch('custom_order_placement', ['order' => $observer->getEvent()->getOrder()]);
    }
 }
