<?php

namespace Shubham\Us22\Block\Adminhtml\Popup\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;

/**
 * Class GenericButton
 */
class GenericButton
{
    protected $blockRepository;

    /**
     * @param UrlInterface $urlInterface
     * @param BlockRepositoryInterface $blockRepository
     */
    public function __construct(
        private readonly UrlInterface $urlInterface,
        private readonly RequestInterface $request,
    ) {}

    /**
     * Return Popup ID
     *
     * @return int|null
     */
    public function getPopupId(): int
    {
        return (int) $this->request->getParam('popup_id', 0);
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->urlInterface->getUrl($route, $params);
    }
}
