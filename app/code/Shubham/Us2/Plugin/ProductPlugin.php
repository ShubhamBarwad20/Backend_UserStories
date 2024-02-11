<?php

declare(strict_types= 1);

namespace Shubham\Us2\Plugin;

class ProductPlugin
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $result .= ' On Sale!';
        if ($subject->getFinalPrice() < 60) {
            if($subject->getFinalPrice() < 20) {
                $result .= 'WholeSale !! <strong>Discount %15</strong>';
            }else if($subject->getFinalPrice() < 50) {
                $result .= 'Super Sale!!';
            }
        }
        return $result;
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        // if($subject->getFinalPrice() < 50) {
            // if($subject->getFinalPrice() > 20){
                $result = $result*0.85;
                $result = $result + 1.79;
            // }
        // }
        return $result;
    }
}