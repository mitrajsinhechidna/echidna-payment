<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Shared\EchidnaPayment;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface EchidnaPaymentConstants
{
    /**
     * @var string
     */
    public const PROVIDER_NAME = 'EchidnaPayment';

    /**
     * @var string
     */
    public const LAST_NAME_FOR_INVALID_TEST = 'Invalid';
}
