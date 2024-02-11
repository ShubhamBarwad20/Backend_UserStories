<?php

declare(strict_types= 1);

namespace Shubham\Us8\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Shubham\Us8\Model\EmployeeModel as EmployeeFactory;
use Shubham\Us8\Model\ResourceModel\EmployeeModel as EmployeeRepostory;
use Magento\Framework\ObjectManagerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


const EMPLOYEE_TABLE_NAME = 'employee_table';

class HandleForm extends Action
{
    private $context;
    private $resultPageFactory;
    private $employeeFactory;
    private $employeeRepostory;
    private $objectManager;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param EmployeeFactory $employeeFactory
     * @param EmployeeRepostory $employeeRepostory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, EmployeeFactory $employeeFactory, EmployeeRepostory $employeeRepostory, ObjectManagerInterface $objectManager)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->employeeFactory = $employeeFactory;
        $this->employeeRepostory = $employeeRepostory;
        $this->objectManager = $objectManager;
        parent::__construct($context);
    }

    public function execute()
    {
        // Handle form submission
        if ($postData = $this->getRequest()->getPostValue()) {
            $logFile = BP . '/var/log/custom.log';
            $logger = new Logger('custom');
            $logger->pushHandler(new StreamHandler($logFile, Logger::DEBUG));
            try {
                // Creating an instance of the Employee model
                $employee = $this->objectManager->create('Shubham\Us8\Model\EmployeeModel');
                $employee->setData('first_name', $postData['first_name']);
                $employee->setData('last_name', $postData['last_name']);
                $employee->setData('email_id', $postData['email']);
                $employee->save();
                
                $this->messageManager->addSuccessMessage(__('Employee data saved successfully.'));

                $logger->info(print_r('Added new employee', true));
            } catch (\Exception $e) {
                $logger->info(print_r('Error occurred '.$e->__toString(), true));
                $this->messageManager->addErrorMessage(__('Error occurred while saving employee data.'));
            }

        }
        // Handle get request form submission
        // if ($this->getRequest()->isGet()) {
        //     // Add Employee value to table
        //     $employeeData = [
        //         'first_name' => 'John',
        //         'last_name' => 'Doe',
        //         'email_id' => 'john.doe@example.com',
        //     ];

        //     $employeeModel = $this->objectManager->create('Shubham\Us8\Model\EmployeeModel');
        //     $employeeModel->setData($employeeData);
        //     $employeeModel->save();
        // }

        
    }
}