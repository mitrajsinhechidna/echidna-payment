<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\EchidnaPayment\Business\Model\Payment;

use Orm\Zed\Sales\Persistence\SpySalesOrder;

interface RefundInterface
{
    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return void
     */
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity): void;
}
