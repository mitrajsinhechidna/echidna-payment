<?php

/**
 * Copyright © 2016-present Pyz Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\EchidnaPayment\Business;

use Pyz\Zed\EchidnaPayment\Business\Model\Payment\Refund;
use Pyz\Zed\EchidnaPayment\Business\Model\Payment\RefundInterface;
use Pyz\Zed\EchidnaPayment\Dependency\Facade\EchidnaPaymentToRefundFacadeInterface;
use Pyz\Zed\EchidnaPayment\EchidnaPaymentDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\EchidnaPayment\EchidnaPaymentConfig getConfig()
 */
class EchidnaPaymentBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\EchidnaPayment\Business\Model\Payment\RefundInterface
     */
    public function createRefund(): RefundInterface
    {
        return new Refund(
            $this->getRefundFacade(),
        );
    }

    /**
     * @return \Pyz\Zed\EchidnaPayment\Dependency\Facade\EchidnaPaymentToRefundFacadeInterface
     */
    public function getRefundFacade(): EchidnaPaymentToRefundFacadeInterface
    {
        return $this->getProvidedDependency(EchidnaPaymentDependencyProvider::FACADE_REFUND);
    }
}
