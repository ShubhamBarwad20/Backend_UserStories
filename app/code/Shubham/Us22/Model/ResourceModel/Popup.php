<?php

declare(strict_types=1);

namespace Shubham\Us22\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Popup extends AbstractDb
{
    private const TABLE_NAME = 'us22_popup';
    private const PRIMARY_KEY = 'popup_id';
    public function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}