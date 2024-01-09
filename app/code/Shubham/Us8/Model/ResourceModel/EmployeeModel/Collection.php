<?php

namespace Shubham\Us8\Model\ResourceModel\EmployeeModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init("Shubham\Us8\Model\EmployeeModel","Shubham\Us8\Model\ResourceModel\EmployeeModel");
    }
}