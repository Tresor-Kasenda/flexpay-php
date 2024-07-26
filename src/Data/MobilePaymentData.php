<?php

declare(strict_types=1);

namespace Tresor\Flexpay\Data;

final class MobilePaymentData
{
    /**
     * @param string $merchant
     * @param string|int $type
     * @param string $phoneNumber
     * @param string $reference
     * @param float|int $amount
     * @param Currency $currency
     * @param string $callback
     */
    public function __construct(
        public string $merchant,
        public string|int $type,
        public string $phoneNumber,
        public string $reference,
        public float|int $amount,
        public Currency $currency,
        public string $callback
    ){}

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode([
            'merchant' => $this->merchant,
            'type' => $this->type,
            'phoneNumber' => $this->phoneNumber,
            'reference' => $this->reference,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'callback' => $this->callback,
        ]);
    }
}
