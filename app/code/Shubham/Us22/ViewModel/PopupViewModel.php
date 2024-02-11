<?php
declare(strict_types=1);

namespace Shubham\Us22\ViewModel;
use Shubham\Us22\Api\Data\PopupInterface;
use Shubham\Us22\Api\PopupManagementInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PopupViewModel implements ArgumentInterface
{
    public function __construct(
        private readonly PopupManagementInterface $popupManagement
    )
    {}

    public function getPopup(): PopupInterface
    {
        return $this->popupManagement->getApplicablePopup();
    }
}