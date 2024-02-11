<?php
declare(strict_types=1);

namespace Shubham\Us22\Service;

use Shubham\Us22\Api\PopupManagementInterface;
use Shubham\Us22\Api\Data\PopupInterface;
use Shubham\Us22\Model\ResourceModel\Popup\Collection;
use Shubham\Us22\Model\ResourceModel\Popup\CollectionFactory;

class PopupManagement implements PopupManagementInterface
{
    public function __construct(
        private readonly CollectionFactory $popupCollectionFactory
    ){}
    public function getApplicablePopup()
    {
        $popup = $this->getCollection()
                    ->addFieldToFilter('is_active', PopupInterface::STATUS_ENABLED)
                    ->addOrder('popup_id')
                    ->getFirstItem();

        return $popup;
    }

    private function getCollection(): Collection
    {
        return $this->popupCollectionFactory->create();
    }
}