<?php

declare(strict_types= 1);

namespace Shubham\Us5\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    private $resultPageFactory;
    public function __construct(PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}