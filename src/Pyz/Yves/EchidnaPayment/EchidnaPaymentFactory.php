<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\EchidnaPayment;

use Pyz\Yves\EchidnaPayment\Form\CreditCardSubForm;
use Pyz\Yves\EchidnaPayment\Form\DataProvider\EchidnaPaymentCreditCardFormDataProvider;
use Pyz\Yves\EchidnaPayment\Handler\EchidnaPaymentHandler;
use Spryker\Yves\Kernel\AbstractFactory;
use Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface;

class EchidnaPaymentFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Yves\StepEngine\Dependency\Form\SubFormInterface
     */
    public function createCreditCardForm(): SubFormInterface
    {
        return new CreditCardSubForm();
    }

    /**
     * @return \Pyz\Yves\EchidnaPayment\Form\DataProvider\EchidnaPaymentCreditCardFormDataProvider
     */
    public function createCreditCardFormDataProvider(): EchidnaPaymentCreditCardFormDataProvider
    {
        return new EchidnaPaymentCreditCardFormDataProvider();
    }

    /**
     * @return \Pyz\Yves\EchidnaPayment\Handler\EchidnaPaymentHandler
     */
    public function createEchidnaPaymentHandler(): EchidnaPaymentHandler
    {
        return new EchidnaPaymentHandler();
    }
}
