<?php

declare(strict_types=1);

namespace Tresor\Flexpay\Data;

final class CardPaymentData
{
    /**
     * @param string $merchant
     * @param string $reference
     * @param float|int $amount
     * @param Currency $currency
     * @param string $description
     */
    public function __construct(
        public string $merchant,
        public string $reference,
        public float|int $amount,
        public Currency $currency,
        public string $description,
        public ?string $callbackUrl
    ){}

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode([
            'merchant' => $this->merchant,
            'reference' => $this->reference,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'description' => $this->description,
            'callback' => $this->callbackUrl
        ]);
    }
}
