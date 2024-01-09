<?php

namespace Shubham\Us8\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\TestFramework\Utility\ChildrenClassesSearch\C;

class EmployeeModel extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Shubham\Us8\Model\ResourceModel\EmployeeModel');
    }
}