<?php

namespace Shubham\Us16\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class BgColorBlock extends Template
{

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    public function __construct(ScopeConfigInterface $scopeConfig, Context $context, array $data = [])
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    // Method to see background color config is enabled
    public function isEnabled()
    {
        return $this->scopeConfig->getValue('shubham_us16_section/shubham_us16_group/enable');
    }
    public function getBgColor()
    {
        if ($this->isEnabled()) {
            // Get background color from configuration
            return $bgColor = $this->scopeConfig->getValue('shubham_us16_section/shubham_us16_group/background_colour');
        }
        return null;
    }
}