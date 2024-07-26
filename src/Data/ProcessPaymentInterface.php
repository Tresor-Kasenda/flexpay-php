<?php

declare(strict_types=1);

namespace Tresor\Flexpay\Data;

interface ProcessPaymentInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function process(array $data): mixed;
}
