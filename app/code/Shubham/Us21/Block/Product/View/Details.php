<?php

namespace Shubham\Us21\Block\Product\View;

use Magento\Catalog\Block\Product\View\Details as DetailsCore;
use Magento\Framework\App\RequestInterface;

class Details extends DetailsCore
{
    private $requestInterface;
    function __construct(\Magento\Framework\View\Element\Template\Context $context, RequestInterface $requestInterface, $data = [])
    {
        parent::__construct($context, $data);
        $this->requestInterface = $requestInterface;
    }

    public function isAffiliateLink()
    {
        return $this->requestInterface->getParam('affiliate') === 'true';
    }

}