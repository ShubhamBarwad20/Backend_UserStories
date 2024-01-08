<?php

namespace Shubham\Us6\Plugin;

class SampleDescriptionPlugin
{
    private $descriptionModified = false;

    public function afterToHtml(\Magento\Catalog\Block\Product\View\Description $subject, $result)
    {
        
        if (!$this->descriptionModified) {
            $result = '<p><strong>Sample Description</strong></p>';
            $this->descriptionModified = true;
        }

        return $result;
    }
}
