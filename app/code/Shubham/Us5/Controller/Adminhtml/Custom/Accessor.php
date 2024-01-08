<?php

declare(strict_types= 1);

namespace Shubham\Us5\Controller\Adminhtml\AccessControl;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;

class Accessor extends Action
{
    private $scopeConfig;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        $access = $this->getRequest()->getParam('access');
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($access === 'True') {
            
            $resultPage->getConfig()->getTitle()->prepend('Admin Controller Accessed');

            // echo "Admin Controller Accessed";
        } else {
            $resultPage->getConfig()->getTitle()->prepend('Access Denied');

            // echo "Access Denied";
        }
        return $resultPage;
    }
}