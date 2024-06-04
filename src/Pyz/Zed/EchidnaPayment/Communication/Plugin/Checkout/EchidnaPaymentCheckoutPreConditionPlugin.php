<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\EchidnaPayment\Communication\Plugin\Checkout;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Shared\EchidnaPayment\EchidnaPaymentConfig;
use Spryker\Zed\CheckoutExtension\Dependency\Plugin\CheckoutPreConditionPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\EchidnaPayment\Communication\EchidnaPaymentCommunicationFactory getFactory()
 * @method \Pyz\Zed\EchidnaPayment\Business\EchidnaPaymentFacadeInterface getFacade()
 * @method \Pyz\Zed\EchidnaPayment\EchidnaPaymentConfig getConfig()
 */
class EchidnaPaymentCheckoutPreConditionPlugin extends AbstractPlugin implements CheckoutPreConditionPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return bool
     */
    public function checkCondition(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponseTransfer): bool
    {
        if ($quoteTransfer->getPayment()->getPaymentProvider() === EchidnaPaymentConfig::PROVIDER_NAME) {
            $checkoutResponseTransfer->setIsSuccess(true);
        }

        return true;
    }
}
