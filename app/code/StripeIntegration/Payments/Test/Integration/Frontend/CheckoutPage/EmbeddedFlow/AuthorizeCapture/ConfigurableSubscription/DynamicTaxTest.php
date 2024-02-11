<?php

namespace StripeIntegration\Payments\Test\Integration\Frontend\CheckoutPage\EmbeddedFlow\AuthorizeCapture\ConfigurableSubscription;

use StripeIntegration\Payments\Test\Integration\Mock\StripeIntegration\Payments\Model\Stripe\Event\InvoiceUpcoming as MockInvoiceUpcoming;
/**
 * Magento 2.3.7-p3 does not enable these at class level
 * @magentoAppIsolation enabled
 * @magentoDbIsolation enabled
 */
class DynamicTaxTest extends \PHPUnit\Framework\TestCase
{
    private $objectManager;
    private $quote;
    private $tests;
    private $orderHelper;
    private $address;
    private $invoiceUpcoming;

    public function setUp(): void
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();

        $this->objectManager->configure([
            'preferences' => [
                \StripeIntegration\Payments\Model\Stripe\Event\InvoiceUpcoming::class => MockInvoiceUpcoming::class,
            ]
        ]);

        $this->tests = new \StripeIntegration\Payments\Test\Integration\Helper\Tests($this);
        $this->quote = new \StripeIntegration\Payments\Test\Integration\Helper\Quote();
        $this->orderHelper = $this->objectManager->get(\StripeIntegration\Payments\Helper\Order::class);
        $this->address = $this->objectManager->get(\StripeIntegration\Payments\Test\Integration\Helper\Address::class);
        $this->invoiceUpcoming = $this->objectManager->get(\StripeIntegration\Payments\Model\Stripe\Event\InvoiceUpcoming::class);
    }

    /**
     * @magentoConfigFixture current_store payment/stripe_payments/payment_flow 0
     */
    public function testDynamicTax()
    {
        $this->quote->create()
            ->setCustomer('Guest')
            ->setCart("ConfigurableSubscription")
            ->setShippingAddress("California")
            ->setShippingMethod("FlatRate")
            ->setBillingAddress("California")
            ->setPaymentMethod("SuccessCard");

        $order = $this->quote->placeOrder();
        $paymentIntent = $this->tests->confirmSubscription($order);

        // Refresh the order object
        $order = $this->tests->refreshOrder($order);

        // Get the order tax percent
        $appliedTaxes = $this->orderHelper->getAppliedTaxes($order->getId());
        $this->assertCount(1, $appliedTaxes);
        $this->assertEquals("8.2500", $appliedTaxes[0]['percent']);

        // Stripe checks
        $orderTotal = $order->getGrandTotal() * 100;

        $paymentIntentId = $order->getPayment()->getLastTransId();
        $paymentIntent = $this->tests->stripe()->paymentIntents->retrieve($paymentIntentId, []);
        $this->tests->compare($paymentIntent, [
            "amount" => $orderTotal,
            "amount_received" => $orderTotal,
            // "description" => $this->tests->helper()->getOrderDescription($order)
        ]);

        $customerId = $paymentIntent->customer;
        $customer = $this->tests->stripe()->customers->retrieve($customerId);
        $this->assertCount(1, $customer->subscriptions->data);
        $subscription = $customer->subscriptions->data[0];
        $this->tests->compare($subscription, [
            "items" => [
                "data" => [
                    0 => [
                        "plan" => [
                            "amount" => $orderTotal,
                            "currency" => "usd",
                            "interval" => "month",
                            "interval_count" => 1
                        ],
                        "price" => [
                            "recurring" => [
                                "interval" => "month",
                                "interval_count" => 1
                            ],
                            "unit_amount" => $orderTotal
                        ],
                        "quantity" => 1
                    ]
                ]
            ],
            "metadata" => [
                "Order #" => $order->getIncrementId()
            ],
            "status" => "active"
        ]);

        // If we trigger an invoice.upcoming webhook once, we expect no change in the subscription price
        $this->tests->event()->trigger("invoice.upcoming", $subscription->latest_invoice);
        $subscription = $this->tests->stripe()->subscriptions->retrieve($subscription->id);
        $this->tests->compare($subscription, [
            "items" => [
                "data" => [
                    0 => [
                        "plan" => [
                            "amount" => $orderTotal,
                            "currency" => "usd",
                            "interval" => "month",
                            "interval_count" => 1
                        ],
                        "price" => [
                            "recurring" => [
                                "interval" => "month",
                                "interval_count" => 1
                            ],
                            "unit_amount" => $orderTotal
                        ],
                        "quantity" => 1
                    ]
                ]
            ],
            "metadata" => [
                "Order #" => $order->getIncrementId()
            ],
            "status" => "active"
        ]);

        // Change the order's shipping and billing address, so that the tax rate becomes 8.375%
        $newYorkData = $this->address->getMagentoFormat("NewYork");
        $order->getShippingAddress()->addData($newYorkData)->save();
        $order->getBillingAddress()->addData($newYorkData)->save();
        $this->tests->helper()->clearCache();

        // Count the active quotes
        $count = $this->countActiveQuotes();

        // Trigger an invoice.upcoming webhook
        $this->tests->event()->trigger("invoice.upcoming", $subscription->latest_invoice);

        // Count the active quotes
        $this->assertEquals($count, $this->countActiveQuotes());

        // The subscription price should now have been updated to match the new tax rate. Check if that is indeed the case
        $subscription = $this->tests->stripe()->subscriptions->retrieve($subscription->id);

        $expectedTotal = (10 + 0.84 + 5) * 100; // $10 product price, $0.84 tax, $5 shipping
        $this->tests->compare($subscription, [
            "items" => [
                "data" => [
                    0 => [
                        "plan" => [
                            "amount" => $expectedTotal,
                            "currency" => "usd",
                            "interval" => "month",
                            "interval_count" => 1
                        ],
                        "price" => [
                            "recurring" => [
                                "interval" => "month",
                                "interval_count" => 1
                            ],
                            "unit_amount" => $expectedTotal
                        ],
                        "quantity" => 1
                    ]
                ]
            ],
            "metadata" => [
                "Order #" => $order->getIncrementId()
            ],
            "status" => "active"
        ]);

        // Change the original tax back to 8.25%
        $newYorkData = $this->address->getMagentoFormat("California");
        $order->getShippingAddress()->addData($newYorkData)->save();
        $order->getBillingAddress()->addData($newYorkData)->save();

        // Triggering a second invoice.upcoming and check price again
        $this->tests->event()->trigger("invoice.upcoming", $subscription->latest_invoice);
        $subscription = $this->tests->stripe()->subscriptions->retrieve($subscription->id);
        $this->tests->compare($subscription, [
            "items" => [
                "data" => [
                    0 => [
                        "plan" => [
                            "amount" => $expectedTotal,
                            "currency" => "usd",
                            "interval" => "month",
                            "interval_count" => 1
                        ],
                        "price" => [
                            "recurring" => [
                                "interval" => "month",
                                "interval_count" => 1
                            ],
                            "unit_amount" => $expectedTotal
                        ],
                        "quantity" => 1
                    ]
                ]
            ],
            "metadata" => [
                "Order #" => $order->getIncrementId()
            ],
            "status" => "active"
        ]);
    }

    protected function countActiveQuotes()
    {
        $quoteCollection = $this->objectManager->create(\Magento\Quote\Model\ResourceModel\Quote\Collection::class);
        $quoteCollection->addFieldToFilter('is_active', 1);
        return $quoteCollection->count();
    }
}
