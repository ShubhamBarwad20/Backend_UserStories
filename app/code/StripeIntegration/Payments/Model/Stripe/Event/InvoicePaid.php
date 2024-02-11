<?php

namespace StripeIntegration\Payments\Model\Stripe\Event;

class InvoicePaid extends \StripeIntegration\Payments\Model\Stripe\Event
{
    public function process($arrEvent, $object)
    {
        $order = $this->webhooksHelper->loadOrderFromEvent($arrEvent);
        $paymentMethod = $order->getPayment()->getMethod();

        if ($paymentMethod != "stripe_payments_invoice")
            return;

        if (!empty($object['payment_intent']))
        {
            $this->config->getStripeClient()->paymentIntents->update($object['payment_intent'], [
                'metadata' => $this->config->getMetadata($order),
                'description' => $this->helper->getOrderDescription($order)
            ]);
        }

        $order->getPayment()->setLastTransId($object['payment_intent'])->save();

        foreach($order->getInvoiceCollection() as $invoice)
        {
            $invoice->setTransactionId($object['payment_intent']);
            $invoice->setRequestedCaptureCase(\Magento\Sales\Model\Order\Invoice::CAPTURE_OFFLINE);
            $invoice->pay();
            $this->helper->saveInvoice($invoice);
        }
    }
}