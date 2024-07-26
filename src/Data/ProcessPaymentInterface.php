<?php

declare(strict_types=1);

namespace Tresor\Flexpay\Data;

use Tresor\Flexpay\Exception\PaymentErrorException;

/**
 * Interface ProcessPaymentInterface
 */
interface ProcessPaymentInterface
{
    /**
     * @param string $data
     * @return array|mixed|void|PaymentErrorException|mixed
     */
    public function process(string $data):  mixed;
}
