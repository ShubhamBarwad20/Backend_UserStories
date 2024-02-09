<?php
namespace Shubham\Us2\Plugin;

class BreadcrumbsPlugin
{
    public function beforeAddCrumb(
        \Magento\Theme\Block\Html\Breadcrumbs $subject,
        $crumbName,
        $crumbInfo
    ) {
        $crumbInfo['label'] = 'Hummingbird ' . $crumbInfo['label'];
        return [$crumbName, $crumbInfo];
    }
}