<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\EchidnaPayment\Communication\Plugin\Checkout;

use Generated\Shared\Transfer\CheckoutErrorTransfer;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Shared\EchidnaPayment\EchidnaPaymentConfig;
use Pyz\Shared\EchidnaPayment\EchidnaPaymentConstants;
use Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPostSaveInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\EchidnaPayment\Business\EchidnaPaymentFacadeInterface getFacade()
 * @method \Pyz\Zed\EchidnaPayment\Communication\EchidnaPaymentCommunicationFactory getFactory()
 * @method \Pyz\Zed\EchidnaPayment\EchidnaPaymentConfig getConfig()
 */
class EchidnaPaymentCheckoutPostSavePlugin extends AbstractPlugin implements CheckoutPostSaveInterface
{
    /**
     * @var string
     */
    public const ERROR_CODE_PAYMENT_FAILED = 'payment failed';

    /**
     * {@inheritDoc}
     * - Works only if QuoteTransfer.payment.paymentProvider is 'DummyPayment' otherwise does nothing.
     * - If QuoteTransfer.billingAddress.lastName is 'Invalid' the plugin adds the error into CheckoutResponseTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return void
     */
    public function executeHook(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer): void
    {
        if ($quoteTransfer->getPayment()->getPaymentProvider() !== EchidnaPaymentConfig::PROVIDER_NAME) {
            return;
        }

        if (!$this->isAuthorizationApproved($quoteTransfer)) {
            $checkoutErrorTransfer = (new CheckoutErrorTransfer())
                ->setErrorCode(static::ERROR_CODE_PAYMENT_FAILED)
                ->setMessage('Something went wrong with your payment. Try again!');

            $checkoutResponseTransfer->addError($checkoutErrorTransfer)
                ->setIsSuccess(false);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function isAuthorizationApproved(QuoteTransfer $quoteTransfer): bool
    {
        /** @var \Generated\Shared\Transfer\AddressTransfer $billingAddress */
        $billingAddress = $quoteTransfer->requireBillingAddress()->getBillingAddress();

        return ($billingAddress->getLastName() !== EchidnaPaymentConstants::LAST_NAME_FOR_INVALID_TEST);
    }
}
