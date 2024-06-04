<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\EchidnaPayment\Handler;

use Generated\Shared\Transfer\EchidnaPaymentTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Shared\EchidnaPayment\EchidnaPaymentConfig;
use Pyz\Yves\EchidnaPayment\Exception\PaymentMethodNotFoundException;

class EchidnaPaymentHandler
{
    /**
     * @var string
     */
    public const PAYMENT_PROVIDER = 'EchidnaPayment';

    /**
     * @var array
     */
    protected static $paymentMethods = [
        EchidnaPaymentConfig::PAYMENT_METHOD_CREDIT_CARD => 'credit card',
    ];

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function addPaymentToQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        $paymentSelection = $quoteTransfer->getPayment()->getPaymentSelection();

        $this->setPaymentProviderAndMethod($quoteTransfer, $paymentSelection);
        $this->setEchidnaPayment($quoteTransfer, $paymentSelection);

        return $quoteTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $paymentSelection
     *
     * @return void
     */
    protected function setPaymentProviderAndMethod(QuoteTransfer $quoteTransfer, string $paymentSelection): void
    {
        $quoteTransfer->getPayment()
            ->setPaymentProvider(static::PAYMENT_PROVIDER)
            ->setPaymentMethod(static::$paymentMethods[$paymentSelection]);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $paymentSelection
     *
     * @return void
     */
    protected function setEchidnaPayment(QuoteTransfer $quoteTransfer, string $paymentSelection): void
    {
        $echidnaPaymentTransfer = $this->getEchidnaPaymentTransfer($quoteTransfer, $paymentSelection);

        $quoteTransfer->getPayment()->setEchidnaPayment(clone $echidnaPaymentTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param string $paymentSelection
     *
     * @throws \Pyz\Yves\EchidnaPayment\Exception\PaymentMethodNotFoundException
     *
     * @return \Generated\Shared\Transfer\EchidnaPaymentTransfer
     */
    protected function getEchidnaPaymentTransfer(QuoteTransfer $quoteTransfer, string $paymentSelection): EchidnaPaymentTransfer
    {
        $paymentMethod = ucfirst($paymentSelection);
        $method = 'get' . $paymentMethod;
        $paymentTransfer = $quoteTransfer->getPayment();
        if (!method_exists($paymentTransfer, $method) || ($quoteTransfer->getPayment()->$method() === null)) {
            throw new PaymentMethodNotFoundException(sprintf('Selected payment method "%s" not found in PaymentTransfer', $paymentMethod));
        }
        $echidnaPaymentTransfer = $quoteTransfer->getPayment()->$method();

        return $echidnaPaymentTransfer;
    }
}
