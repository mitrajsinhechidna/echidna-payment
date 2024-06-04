<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\EchidnaPayment\Dependency\Injector;

use Pyz\Zed\EchidnaPayment\Communication\Plugin\Oms\Condition\IsAuthorizedPlugin;
use Pyz\Zed\EchidnaPayment\Communication\Plugin\Oms\Condition\IsPayedPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Dependency\Injector\AbstractDependencyInjector;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionCollectionInterface;
use Spryker\Zed\Oms\OmsDependencyProvider;

class OmsDependencyInjector extends AbstractDependencyInjector
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function injectBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->injectConditions($container);
        return $container;
    }


    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function injectConditions(Container $container): Container
    {
        $container->extend(OmsDependencyProvider::CONDITION_PLUGINS, function (ConditionCollectionInterface $conditionCollection) {
            $conditionCollection->add(new IsAuthorizedPlugin(), 'EchidnaPayment/IsAuthorized');
            $conditionCollection->add(new IsPayedPlugin(), 'EchidnaPayment/IsPayed');

            return $conditionCollection;
        });

        return $container;
    }
}
