<?php
declare(strict_types=1);

namespace Shubham\Us22\Model\ResourceModel\Popup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Shubham\Us22\Model\Popup::class,
            \Shubham\Us22\Model\ResourceModel\Popup::class
        );
    }
}