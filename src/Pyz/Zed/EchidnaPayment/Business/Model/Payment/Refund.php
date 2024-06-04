<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\EchidnaPayment\Business\Model\Payment;

use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Pyz\Zed\EchidnaPayment\Dependency\Facade\EchidnaPaymentToRefundFacadeInterface;

class Refund implements RefundInterface
{
    /**
     * @var \Pyz\Zed\EchidnaPayment\Dependency\Facade\EchidnaPaymentToRefundFacadeInterface
     */
    protected $refundFacade;

    /**
     * @param \Pyz\Zed\EchidnaPayment\Dependency\Facade\EchidnaPaymentToRefundFacadeInterface $refundFacade
     */
    public function __construct(EchidnaPaymentToRefundFacadeInterface $refundFacade)
    {
        $this->refundFacade = $refundFacade;
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return void
     */
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity): void
    {
        $refundTransfer = $this->refundFacade->calculateRefund($salesOrderItems, $salesOrderEntity);
        $paymentRefundResult = $this->refundPayment($refundTransfer);

        if ($paymentRefundResult) {
            $this->refundFacade->saveRefund($refundTransfer);
        }
    }

    /**
     * This is just a fake method, in a normal environment you would call your facade and trigger the refund process.
     *
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return bool
     */
    protected function refundPayment(RefundTransfer $refundTransfer): bool
    {
        return ($refundTransfer->getAmount() > 0);
    }
}
