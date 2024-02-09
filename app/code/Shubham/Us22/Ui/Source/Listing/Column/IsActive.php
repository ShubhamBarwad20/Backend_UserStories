<?php
declare(strict_types=1);

namespace Shubham\Us22\Ui\Source\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{
    private const ENABLED = 1;
    private const DISABLED = 0;
    public function toOptionArray() : array
    {
        return [
            [
                'label' => __('Disabled'),
                'value' => self::DISABLED,
            ],
            [
                'label' => __('Enabled'),
                'value' => self::ENABLED,
            ],
        ];
    }
}