<?php

declare(strict_types=1);

namespace Tresor\Flexpay\Data;

enum Currency: string
{
    case USD = "USD";

    case CDF = "CDF";
}
