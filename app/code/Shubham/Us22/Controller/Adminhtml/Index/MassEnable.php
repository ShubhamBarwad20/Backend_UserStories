<?php
namespace Shubham\Us22\Controller\Adminhtml\Index;

use Shubham\Us22\Api\Data\PopupInterface;
use Shubham\Us22\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Shubham\Us22\Model\ResourceModel\Popup\CollectionFactory;

class MassEnable extends Action
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
                $item->setIsActive(PopupInterface::STATUS_ENABLED);
                $this->popupRepository->save($item);
            }
            $this->messageManager->addSuccessMessage(__("A total of %1 record(s) have been enabled.", $collectionSize));
        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while enabling the popup(s).'));
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('popup/index/index');
    }
}
