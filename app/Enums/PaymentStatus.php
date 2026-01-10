<?php

namespace App\Enums;

// https://www.mercadopago.com.ar/developers/en/docs/checkout-api-orders/payment-management/status/order-status
enum PaymentStatus: string
{
    case CREATED = 'created';
    case PROCESSED = 'processed';
    case PROCESSING = 'processing';
    case ACTION_REQUIRED = 'action_required';
    case CANCELLED = 'canceled';
    case CHARGED_BACK = 'charged_back';
    case EXPIRED = 'expired';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}
