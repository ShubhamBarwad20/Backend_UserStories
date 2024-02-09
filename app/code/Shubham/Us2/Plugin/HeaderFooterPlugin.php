<?php
namespace Shubham\Us2\Plugin;

class HeaderFooterPlugin
{
    public function afterGetWelcome(\Magento\Theme\Block\Html\Header $subject, $result)
    {
        return "Hello! Welcome to Shubham's Store";
    }

    public function afterGetCopyright(\Magento\Theme\Block\Html\Footer $subject, $result)
    {
      return '© 2023 Shubham Barwad. All Rights Reserved.';
    }
}