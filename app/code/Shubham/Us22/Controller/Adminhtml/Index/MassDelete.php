<?php
namespace Shubham\Us22\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;
use Shubham\Us22\Model\ResourceModel\Popup\CollectionFactory;
use Shubham\Us22\Api\PopupRepositoryInterface;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var PopupRepositoryInterface
     */
    protected $popupRepository;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param PopupRepositoryInterface $popupRepository
     */
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

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface
     */
    public function execute() : ResultInterface
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        try {
            foreach ($collection as $item) {
                $this->popupRepository->delete($item);
            }
            $this->messageManager->addSuccessMessage(__("A total of %1 record(s) have been deleted.", $collectionSize));
        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while deleting the popup(s).'));
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('popup/index/index');
    }
}
