<?php

declare(strict_types= 1);

namespace Shubham\Us7\Block;

use Magento\Framework\View\Element\Template;

class Message extends Template
{
    public function _afterToHtml($html)
    {
        return $html."<p>Custom Message</p>";
    }
}