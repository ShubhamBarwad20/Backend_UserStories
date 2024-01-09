<?php

declare(strict_types= 1);

namespace Shubham\Us8\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class HandleForm extends Action
{
    private $context;
    private $resultPageFactory;
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // Handle form submission
        if ($postData = $this->getRequest()->getPostValue()) {
            try {
                // Creating an instance of the Employee model
                $employee = $this->objectManager->create('Shubham\Us8\Model\EmployeeModel');
                $employee->setData($postData);
                $employee->save();
                
                $this->messageManager->addSuccessMessage(__('Employee data saved successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error occurred while saving employee data.'));
            }

        }
    }
}