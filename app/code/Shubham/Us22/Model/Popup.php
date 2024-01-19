<?php
declare(strict_types=1);

namespace Shubham\Us22\Model;

use Magento\Framework\Model\AbstractModel;
use Shubham\Us22\Api\Data\PopupInterface;
use Magento\Framework\Api\CustomAttributesDataInterface;

class Popup extends AbstractModel implements PopupInterface, CustomAttributesDataInterface
{
    private const POPUP_ID = 'popup_id';
    private const NAME = 'name';
    private const CONTENT = 'content';
    private const CREATED_AT = 'created_at';
    private const UPDATED_AT = 'updated_at';
    private const IS_ACTIVE = 'is_active';
    private const TIMEOUT = 'timeout';


    protected function _construct()
    {
        $this->_eventPrefix = 'shubham_us22';
        $this->_eventObject = 'popup';
        $this->_idFieldName = self::POPUP_ID;
        $this->_init(\Shubham\Us22\Model\ResourceModel\Popup::class);
    }

    public function getPopupId() : int
    {
        return $this->getData(self::POPUP_ID);
    }

    public function setPopupID(int $popupId)
    {
        $this->setData(self::POPUP_ID, $popupId);
    }

    public function getName() : string
    {
        return $this->getData(self::NAME);
    }

    public function setName(string $name)
    {
        $this->setData(self::NAME, $name);
    }

    public function getContent() : string
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent(string $content)
    {
        $this->setData(self::CONTENT, $content);
    }

    public function getCreatedAt() : string
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt() : string
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt(string $updatedAt)
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function getTimeout() : int
    {
        return $this->getData(self::TIMEOUT);
    }

    public function setTimeout(int $timeout)
    {
        $this->setData(self::TIMEOUT, $timeout);
    }

    public function getIsActive() : bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    public function setIsActive(bool $isActive)
    {
        $this->setData(self::IS_ACTIVE, $isActive);
    }

    public function getCustomAttributes()
    {
        return [];
    }

    public function getCustomAttribute($attributeCode)
    {
        return null;
    }
    public function setCustomAttribute($attributeCode, $attributeValue)
    {
        // Implementation of setCustomAttribute method
    }

    public function setCustomAttributes(array $attributes)
    {
        // Implementation of setCustomAttributes method
    }
}