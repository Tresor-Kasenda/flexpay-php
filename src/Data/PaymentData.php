<?php

declare(strict_types=1);

namespace Tresor\Flexpay\Data;

final class PaymentData
{
    public function __construct(
        public string $merchant,
        public string $reference,
        public float|int $amount,
        public Currency $currency,
        public string $description,
    ){}

    public function toJson(): string
    {
        return json_encode([
            'merchant' => $this->merchant,
            'reference' => $this->reference,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'description' => $this->description,
        ]);
    }
}
