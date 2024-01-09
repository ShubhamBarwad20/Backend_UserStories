<?php

namespace Shubham\Us9\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Action
{
    protected $resultPageFactory;
    protected $scopeConfig;
    public function __construct(Context $context, PageFactory $resultPageFactory, ScopeConfigInterface $scopeConfig)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        $enableValue = $this->scopeConfig->getValue('humc_fmc/humc_fmc_admin/enable');
        $configText = $this->scopeConfig->getValue('humc_fmc/humc_fmc_admin/display_text');
        if ($enableValue) {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend(__($configText));
            return $resultPage;
        }
    }
}