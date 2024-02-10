<?php

declare(strict_types= 1);

namespace Shubham\Us2\Plugin;

class ProductPlugin
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        if ($subject->getFinalPrice() < 60) {
            $result .= ' On Sale!';
        }
        return $result;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        if($subject->getFinalPrice() < 50) {
            // if($subject->getFinalPrice() > 20){
                $result = $result*0.85;
            // }
        }
        return $result;
    }
}