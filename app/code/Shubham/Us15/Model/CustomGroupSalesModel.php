<?php
// app/code/Shubham/Us15/Model/CustomGroupSalesModel.php

namespace Shubham\Us15\Model;

use Magento\Framework\Model\AbstractModel;

class CustomGroupSalesModel extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Shubham\Us15\Model\ResourceModel\CustomGroupSalesModel');
    }
}
