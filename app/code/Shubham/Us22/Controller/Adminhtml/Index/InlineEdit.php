<?php
namespace Shubham\Us22\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Shubham\Us22\Api\PopupRepositoryInterface;
use Magento\Framework\Controller\ResultFactory;

class InlineEdit extends Action
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
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $items = $this->getRequest()->getParam('items');
        $messages = [];
        $error = false;
    
        if(!count($items)){
            $messages[] = __('Please correct the data sent.');
            $error = true;
        }else {
            foreach(array_keys($items) as $popupId) {
                try{
                    $popup = $this->popupRepository->getById((int) $popupId);
                    $popup->setData(array_merge($popup->getData(), $items[$popupId]));
                    $this->popupRepository->save($popup);
                } catch (\Throwable $exception) {
                    $messages[] = '[Popup ID: '. $popupId . '] ' . $exception->getMessage();
                    $error = true;
                }
                
            }
        }


        return $resultRedirect->setData(
            ['messages' => $messages, 'error' => $error]
        );
    }
}
