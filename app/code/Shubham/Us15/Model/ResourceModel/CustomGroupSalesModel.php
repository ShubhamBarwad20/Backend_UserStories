<?php
namespace Shubham\Us15\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomGroupSalesModel extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('custom_customer_group_sales', 'customer_group_id');
    }

    // Check if a record exists based on customer_group_id
    public function exists($customer_group_id)
    {
        $select = $this->getConnection()->select()
            ->from($this->getMainTable(), 'customer_group_id')
            ->where('customer_group_id = ?', $customer_group_id);
        $result = $this->getConnection()->fetchOne($select);
        if ($result) {
            return true;
        }
        return false;
    }

    // Get total purchase amount
    public function getTotalPurchaseAmount($customerGroupId)
    {
        $select = $this->getConnection()->select()
            ->from($this->getMainTable(), 'total_purchase_amount')
            ->where('customer_group_id = ?', $customerGroupId);
        return $this->getConnection()->fetchOne($select);
    }

    // Add a record to the table
    public function addRecord($data)
    {
        $this->getConnection()->insert($this->getMainTable(), $data);
    }

    /**
     * Check if a record exists based on customer_group_id, calculate the total purchase amount, and update the table.
     * If the record doesn't exist, add the record.
     *
     * @param int $customerGroupId
     * @param float $newPurchaseAmount
     * @return void
     */
    public function updateTotalPurchaseAmount($customerGroupId, $newPurchaseAmount)
    {
        if ($this->exists($customerGroupId)) {
            $existingAmount = $this->getTotalPurchaseAmount($customerGroupId);
            $totalAmount = $existingAmount + $newPurchaseAmount;
            $data = [
                'total_purchase_amount' => $totalAmount
            ];
            $where = ['customer_group_id = ?' => $customerGroupId];
            $this->getConnection()->update($this->getMainTable(), $data, $where);
        } else {
            $data = [
                'customer_group_id' => $customerGroupId,
                'total_purchase_amount' => $newPurchaseAmount
            ];
            $this->addRecord($data);
        }
    }
    
}
