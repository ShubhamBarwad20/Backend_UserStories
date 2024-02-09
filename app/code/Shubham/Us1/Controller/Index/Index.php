<?php

declare(strict_types= 1);

namespace Shubham\Us1\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

use Shubham\Us1\Test;

class Index extends Action
{
    private $test;
    private $resultJsonFactory;
    public function __construct(Context $context, Test $test, JsonFactory $resultJsonFactory)
    {
        parent::__construct($context);
        $this->test = $test;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        return $result->setData([$this->test->displayParams()]);
    }

}