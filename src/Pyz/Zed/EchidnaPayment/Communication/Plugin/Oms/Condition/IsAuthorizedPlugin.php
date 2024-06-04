<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\EchidnaPayment\Communication\Plugin\Oms\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Pyz\Shared\EchidnaPayment\EchidnaPaymentConstants;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \Pyz\Zed\EchidnaPayment\Communication\EchidnaPaymentCommunicationFactory getFactory()
 * @method \Pyz\Zed\EchidnaPayment\Business\EchidnaPaymentFacadeInterface getFacade()
 * @method \Pyz\Zed\EchidnaPayment\EchidnaPaymentConfig getConfig()
 */
class IsAuthorizedPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        $lastName = $orderItem->getOrder()->getLastName();

        return ($lastName !== EchidnaPaymentConstants::LAST_NAME_FOR_INVALID_TEST);
    }
}
