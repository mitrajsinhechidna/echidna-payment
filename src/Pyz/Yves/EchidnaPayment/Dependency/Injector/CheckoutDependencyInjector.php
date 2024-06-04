<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\EchidnaPayment\Dependency\Injector;

use Pyz\Shared\EchidnaPayment\EchidnaPaymentConfig;
use Spryker\Yves\Checkout\CheckoutDependencyProvider;
use Pyz\Yves\EchidnaPayment\Plugin\EchidnaPaymentCreditCardSubFormPlugin;
use Pyz\Yves\EchidnaPayment\Plugin\EchidnaPaymentHandlerPlugin;
use Spryker\Yves\Kernel\Container;
use Spryker\Yves\Kernel\Dependency\Injector\DependencyInjectorInterface;
use Spryker\Yves\StepEngine\Dependency\Plugin\Form\SubFormPluginCollection;
use Spryker\Yves\StepEngine\Dependency\Plugin\Handler\StepHandlerPluginCollection;

class CheckoutDependencyInjector implements DependencyInjectorInterface
{
    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function inject(Container $container): Container
    {
        $container = $this->injectPaymentSubForms($container);
        $container = $this->injectPaymentMethodHandler($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function injectPaymentSubForms(Container $container): Container
    {
        $container->extend(CheckoutDependencyProvider::PAYMENT_SUB_FORMS, function (SubFormPluginCollection $paymentSubForms) {
            $paymentSubForms->add(new EchidnaPaymentCreditCardSubFormPlugin());

            return $paymentSubForms;
        });

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function injectPaymentMethodHandler(Container $container): Container
    {
        $container->extend(CheckoutDependencyProvider::PAYMENT_METHOD_HANDLER, function (StepHandlerPluginCollection $paymentMethodHandler) {
            $echidnaPaymentHandlerPlugin = new EchidnaPaymentHandlerPlugin();

            $paymentMethodHandler->add($echidnaPaymentHandlerPlugin, EchidnaPaymentConfig::PAYMENT_METHOD_CREDIT_CARD);

            return $paymentMethodHandler;
        });

        return $container;
    }
}
