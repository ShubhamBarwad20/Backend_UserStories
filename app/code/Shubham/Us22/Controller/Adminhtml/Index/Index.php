<?php

declare (strict_types=1);
namespace Shubham\Us22\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public function execute(): ResultInterface
    {   /** @var Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $page->setActiveMenu('Shubham_Us22::popup');
        $page->addBreadcrumb(__('Popups'), __('Popups'));
        $page->addBreadcrumb(__('Manage Popups'), __('Manage Popups'));
        $page->getConfig()->getTitle()->prepend(__('Popups'));

        return $page;
    }
}