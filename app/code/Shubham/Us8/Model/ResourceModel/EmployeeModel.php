<?php

namespace Shubham\Us8\Model\ResourceModel;

class EmployeeModel extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("employee_table","employee_id");
    }
}