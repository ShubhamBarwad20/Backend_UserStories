<?php
namespace Shubham\Us22\Model\ResourceModel\Popup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Shubham\Us22\Model\Popup;
use Shubham\Us22\Model\ResourceModel\Popup as PopupResource;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            Popup::class,
            PopupResource::class
        );
    }
}
