<?php

declare(strict_types= 1);

namespace Shubham\Us5\Plugin;

class CatalogProductViewPlugin
{
    protected $modificationApplied;

    public function afterToHtml(\Magento\Catalog\Block\Product\View $subject,$result)
    {
        if($this->modificationApplied)
        {
            $modifiedResult =  '<div style="color:blue; font-weight:700">
                                    <strong>Modified Product View</strong>
                                </div>';
            $result = $result . $modifiedResult;

            $this->modificationApplied = true;
        }

        return $result;
    }
}