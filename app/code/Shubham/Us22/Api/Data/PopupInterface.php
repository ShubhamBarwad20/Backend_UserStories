<?php

declare(strict_types=1);

namespace Shubham\Us22\Api\Data;

interface PopupInterface
{
    public function getPopupId(): int;
    public function setPopupID(int $popupId);
    public function getName(): string;
    public function setName(string $name);
    public function getContent(): string;
    public function setContent(string $content);
    public function getCreatedAt(): string;
    public function setCreatedAt(string $createdAt);
    public function getUpdatedAt(): string;
    public function setUpdatedAt(string $updatedAt);
    public function getIsActive(): bool;
    public function setIsActive(bool $isActive);
    public function getTimeout(): int;
    public function setTimeout(int $timeout);
}