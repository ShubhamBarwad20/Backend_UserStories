<?php

namespace Shubham\Us8\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;

class EmployeeTable extends Template
{
    /**
     * @var ResourceConnection
     */
    private ResourceConnection $resource;

    /**
     * @var AdapterInterface
     */
    private AdapterInterface $adapter;


    /**
     * @param ResourceConnection $resource
     * @return void
     */
    public function __construct(
        ResourceConnection $resource,
    )
    {
        $this->resource = $resource;
        $this->adapter = $resource->getConnection();
    }

    /**
     * Retrieves all employees from the employee_table.
     *
     * @return array
     */
    public function getEmployees()
    {
        $tableName = $this->resource->getTableName('employee_table');
        $query = "SELECT * FROM " . $tableName;
        $result = $this->adapter->fetchAll($query);
        return $result;
    }
}