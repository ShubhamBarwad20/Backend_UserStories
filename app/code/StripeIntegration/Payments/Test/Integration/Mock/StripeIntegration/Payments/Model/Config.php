<?php

namespace StripeIntegration\Payments\Test\Integration\Mock\StripeIntegration\Payments\Model;

class Config extends \StripeIntegration\Payments\Model\Config
{
    public function getWebhooksSigningSecrets()
    {
        return [];
    }
}