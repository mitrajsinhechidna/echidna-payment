<?php

use Spryker\Shared\DummyPayment\DummyPaymentConfig;
use Spryker\Shared\Kernel\KernelConstants;
use Spryker\Shared\Nopayment\NopaymentConfig;
use Spryker\Shared\Nopayment\NopaymentConstants;
use Spryker\Shared\Oms\OmsConstants;
use Spryker\Shared\Sales\SalesConstants;
use Spryker\Zed\GiftCard\GiftCardConfig;
use Pyz\Shared\EchidnaPayment\EchidnaPaymentConfig;

// ----------------------------------------------------------------------------
// ------------------------------ OMS -----------------------------------------
// ----------------------------------------------------------------------------

$config[KernelConstants::DEPENDENCY_INJECTOR_YVES] = [
    'CheckoutPage' => [
        NopaymentConfig::PAYMENT_PROVIDER_NAME,
        'EchidnaPayment',
    ],
];
$config[KernelConstants::DEPENDENCY_INJECTOR_ZED] = [
    'Payment' => [
        GiftCardConfig::PROVIDER_NAME,
        NopaymentConfig::PAYMENT_PROVIDER_NAME,
        'EchidnaPayment',
    ],
    'Oms' => [
        GiftCardConfig::PROVIDER_NAME,
        'EchidnaPayment',
    ],
];

$config[NopaymentConstants::NO_PAYMENT_METHODS] = [
    NopaymentConfig::PAYMENT_PROVIDER_NAME,
];
$config[NopaymentConstants::WHITELIST_PAYMENT_METHODS] = [
    GiftCardConfig::PROVIDER_NAME,
];

$config[OmsConstants::ACTIVE_PROCESSES] = array_merge([
    'Nopayment01',
    'EchidnaPayment01',
], $config[OmsConstants::ACTIVE_PROCESSES]);

$config[SalesConstants::PAYMENT_METHOD_STATEMACHINE_MAPPING] = array_replace(
    $config[SalesConstants::PAYMENT_METHOD_STATEMACHINE_MAPPING],
    [
    NopaymentConfig::PAYMENT_PROVIDER_NAME => 'Nopayment01',
    EchidnaPaymentConfig::PAYMENT_METHOD_CREDIT_CARD => 'EchidnaPayment01',
    ],
);
