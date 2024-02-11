<?php
namespace Shubham\Us22\Controller\Adminhtml\Index;

use Shubham\Us22\Api\Data\PopupInterface;
use Shubham\Us22\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Shubham\Us22\Model\ResourceModel\Popup\CollectionFactory;
use Shubham\Us22\Service\PopupRepository;
use Magento\Framework\Controller\ResultFactory;

class MassDisable extends Action
{
    protected $filter;
    protected $collectionFactory;
    protected $popupRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->popupRepository = $popupRepository;
    }
    public function execute() : ResultInterface
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create()); 
        $collectionSize = $collection->getSize();

        try{
            foreach($collection as $item) {
                $item->setIsActive(PopupInterface::STATUS_DISABLED);
                $this->popupRepository->save($item);
            }
            $this->messageManager->addSuccessMessage(__("A total of %1 record(s) have been disabled.", $collectionSize));

        }catch(\Throwable $exception){
            $this->messageManager->addErrorMessage(__('Something went wrong while disabling the popup(s).'));
        }


        

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('popup/index/index');
    }
}
