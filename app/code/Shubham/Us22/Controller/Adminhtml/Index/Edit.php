<?php
namespace Shubham\Us22\Controller\Adminhtml\Edit;

// use Shubham\Us22\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
// use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page; 

class Edit extends Action
{
    protected $resultFactory;

    // public function __construct(
    //     Context $context,
    //     private readonly PopupRepositoryInterface $popupRepository
    // )
    // {
    //     parent::__construct($context);
    // }

    public function execute() : ResultInterface
    {
        /** @var Page $page **/
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        
        // $popupId = $this->getRequest()->getParam('popup_id');

        // try{
        //     $popup = $this->popupRepository->getById($popupId);
        // }catch (NoSuchEntityException $e) {
        //     $this->messageManager->addErrorMessage(__('The popup no longer exists.'));
        //     return $resultPage;
        // }

        $resultPage->setActiveMenu('Shubham_Us22::popup');
        $resultPage->addBreadcrumb(__('Popups'), __('Popups'));
        $resultPage->addBreadcrumb(
            // $popup->getPopupId() ? $popup->getName(): __('New Popup'), 
            // $popup->getPopupId() ? $popup->getName(): __('New Popup'));
            __('New Popup'), __('New Popup'));
        $resultPage->getConfig()->getTitle()->prepend(__('Popups'));

        return $resultPage;
    }
}
