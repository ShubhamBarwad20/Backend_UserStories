<?php
namespace Shubham\Us22\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Popup extends AbstractDb
{
    private const TABLE_NAME = 'shubham_popup';
    private const FIELD_NAME = 'popup_id';
    /**
     * Define main table and primary key
     */
    protected function _construct()
    {
        // Define the table name and primary key column
        $this->_init(self::TABLE_NAME, self::FIELD_NAME);
    }

    protected function _beforeSave(AbstractModel $object)
    {
        $object->setData('updated_at', date('Y-m-d H:i:s'));
        return parent::_beforeSave($object);
    }
}
