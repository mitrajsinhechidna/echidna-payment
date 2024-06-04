<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Shared\EchidnaPayment;

interface EchidnaPaymentConfig
{
    /**
     * @var string
     */
    public const PROVIDER_NAME = 'EchidnaPayment';

    /**
     * @var string
     */
    public const PAYMENT_METHOD_CREDIT_CARD = 'echidnaPaymentCreditCard';

    /**
     * @var string
     */
    public const PAYMENT_METHOD_NAME_CREDIT_CARD = 'credit card';
}
