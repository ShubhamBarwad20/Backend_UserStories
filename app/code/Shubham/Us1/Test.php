<?php

namespace Shubham\Us1;

use Magento\Catalog\Api\Data\CategoryInterface;

class Test
{
    protected $category;
    protected $string;
    protected $array;
    public function __construct(CategoryInterface $category, $string='Shubham', $array=[1,2,3])
    {
        $this->category = $category;
        $this->string = $string;
        $this->array = $array;
    }

    public function displayParams()
    {
        echo "<p>";
        print_r($this->array);
        echo "</p>";
        echo "String: ".$this->string;
        return [$this->array, $this->string];
    }
}