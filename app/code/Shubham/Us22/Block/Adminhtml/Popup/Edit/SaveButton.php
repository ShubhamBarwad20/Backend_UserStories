<?php

declare(strict_types=1);

namespace Shubham\Us22\Block\Adminhtml\Popup\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'shubham_popup_form.shubham_popup_form',
                                'actionName' => 'save',
                            ]
                        ]
                    ]
                ]
            ],
            // 'class_name' => Container::SPLIT_BUTTON,
            // 'options' => $this->getOptions(),
            // 'dropdown_button_aria_label' => __('Save options'),
        ];
    }

    /**
     * Retrieve options
     *
     * @return array
     */
    // private function getOptions()
    // {
    //     $options = [
    //         [
    //             'label' => __('Save & Duplicate'),
    //             'id_hard' => 'save_and_duplicate',
    //             'data_attribute' => [
    //                 'mage-init' => [
    //                     'buttonAdapter' => [
    //                         'actions' => [
    //                             [
    //                                 'targetName' => 'cms_block_form.cms_block_form',
    //                                 'actionName' => 'save',
    //                                 'params' => [
    //                                     true,
    //                                     [
    //                                         'back' => 'duplicate'
    //                                     ]
    //                                 ]
    //                             ]
    //                         ]
    //                     ]
    //                 ]
    //             ]
    //         ],
    //         [
    //             'id_hard' => 'save_and_close',
    //             'label' => __('Save & Close'),
    //             'data_attribute' => [
    //                 'mage-init' => [
    //                     'buttonAdapter' => [
    //                         'actions' => [
    //                             [
    //                                 'targetName' => 'cms_block_form.cms_block_form',
    //                                 'actionName' => 'save',
    //                                 'params' => [
    //                                     true,
    //                                     [
    //                                         'back' => 'close'
    //                                     ]
    //                                 ]
    //                             ]
    //                         ]
    //                     ]
    //                 ]
    //             ]
    //         ]
    //     ];

    //     return $options;
    // }
}
