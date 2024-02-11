<?php
namespace Shubham\Us22\Service;

use Shubham\Us22\Api\PopupRepositoryInterface;
use Shubham\Us22\Api\Data\PopupInterface;
use Shubham\Us22\Model\ResourceModel\Popup as PopupResource;
use Shubham\Us22\Model\PopupFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class PopupRepository implements PopupRepositoryInterface
{
    protected $popupResource;
    protected $popupFactory;

    public function __construct(
        PopupResource $popupResource,
        PopupFactory $popupFactory
    ) {
        $this->popupResource = $popupResource;
        $this->popupFactory = $popupFactory;
    }

    public function save(PopupInterface $popup): void
    {
        $this->popupResource->save($popup);
    }

    public function getById(int $popupId): PopupInterface
    {
        $popup = $this->popupFactory->create();
        $this->popupResource->load($popup, $popupId);
        if (!$popup->getId()) {
            throw new NoSuchEntityException(__('Popup with id "%1" does not exist.', $popupId));
        }
        return $popup;
    }

    public function delete(PopupInterface $popup): void
    {
        $this->popupResource->delete($popup);
    }
}
