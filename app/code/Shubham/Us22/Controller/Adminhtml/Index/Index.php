<?php
namespace Shubham\Us22\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
// use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page; 

class Index extends Action
{
    protected $resultFactory;

    public function execute() : ResultInterface
    {
        /** @var Page $page **/
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Popups'));

        $resultPage->setActiveMenu('Shubham_Us22::popup');
        $resultPage->addBreadcrumb(__('Popups'), __('Popups'));
        $resultPage->addBreadcrumb(__('Manage Popups'), __('Manage Popups'));
        $resultPage->getConfig()->getTitle()->prepend(__('Popups'));

        return $resultPage;
    }
}
