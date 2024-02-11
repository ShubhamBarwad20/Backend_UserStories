<?php
namespace Shubham\Us22\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Shubham\Us22\Api\PopupRepositoryInterface;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    /**
     * @var PopupRepositoryInterface
     */
    private $popupRepository;

    /**
     * @param Context $context
     * @param PopupRepositoryInterface $popupRepository
     */
    public function __construct(
        Context $context,
        PopupRepositoryInterface $popupRepository,
    ) {
        parent::__construct($context);
        $this->popupRepository = $popupRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface
     */
    public function execute() : ResultInterface
    {
        $popupId = (int) $this->getRequest()->getParam('popup_id', 0);
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!$popupId) {
            $this->messageManager->addErrorMessage(__('We can\'t find a popup to delete.'));
            return $resultRedirect->setPath('popup/index/index');
        } 
        try {
            $popup = $this->popupRepository->getById($popupId);
            if(!$popup->getPopupId()){
                $this->messageManager->addWarningMessage(__('The popup with the provided id was not found'));
            }
            else{
                $this->popupRepository->delete($popup);
                $this->messageManager->addSuccessMessage(__('The popup has been deleted.'));
            }   
        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while deleting the popup.'));
        }

        return $resultRedirect->setPath('popup/index/index');
    }
}
